<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = User::role('pekerja')->get();
        return view('admin.projects.create', compact('employees'));
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project archived successfully.');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input project
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'description'  => 'nullable|string',
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'status'       => 'required|in:pending,on_progress,completed',
            'created_by'   => 'nullable|integer',
            'approved_by'  => 'nullable|integer',
            'employees'    => 'nullable|array',
            'employees.*'  => 'exists:users,id', // pastikan user ada
        ]);

        DB::transaction(function () use ($validated) {
            $project = Project::create([
                'project_name' => $validated['project_name'],
                'description'  => $validated['description'] ?? null,
                'start_date'   => $validated['start_date'],
                'end_date'     => $validated['end_date'] ?? null,
                'status'       => $validated['status'],
                'created_by'   => Auth::id(),
                'approved_by'  => $validated['approved_by'] ?? null,
            ]);

            // Assign pegawai jika ada
            if (!empty($validated['employees'])) {
                foreach ($validated['employees'] as $user_id) {
                    ProjectAssignment::create([
                        'project_id'    => $project->id,
                        'user_id'       => $user_id,
                        'assigned_date' => now(),
                        'task_description' => null,
                    ]);
                }
            }

            // Kirim notifikasi
        $ownerIds = User::role('owner')->pluck('id')->toArray();  
        $assignedEmployees = $validated['employees'] ?? [];

        $targetUsers = array_unique(array_merge($ownerIds, $assignedEmployees));

        foreach ($targetUsers as $uid) {
            Notification::create([
                'user_id' => $uid,
                'title'   => 'Proyek Baru Ditambahkan',
                'message' => "Proyek '{$project->project_name}' baru saja dibuat.",
                'project_id' => $project->id,
                'is_read' => false,
            ]);
        }

        });

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        // return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $employees = User::role('pekerja')->get();
        $assignedEmployees = $project->assignments()->pluck('user_id')->toArray(); // ambil yang sudah ditugaskan

        return view('admin.projects.edit', compact('project', 'employees', 'assignedEmployees'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'project_name' => 'sometimes|string|max:255',
            'description'  => 'nullable|string',
            'start_date'   => 'sometimes|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'status'       => 'in:pending,on_progress,completed',
            'employees'    => 'nullable|array',
            'employees.*'  => 'integer|exists:users,id',
        ]);

        DB::transaction(function () use ($validated, $project) {
            // Update project
            $project->update($validated);

            // Update assignments
            if (isset($validated['employees'])) {
                $project->assignments()->delete(); // hapus assignment lama
                foreach ($validated['employees'] as $user_id) {
                    ProjectAssignment::create([
                        'project_id'    => $project->id,
                        'user_id'       => $user_id,
                        'assigned_date' => now(),
                    ]);
                }
            }
        });

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function myProjects(Request $request)
    {
        $userId = auth()->id();

        // Query untuk semua proyek pekerja (untuk statistik)
        $allProjects = Project::whereHas('assignments', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->get();

        // Query untuk proyek yang difilter (untuk tabel)
        $query = Project::whereHas('assignments', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        });

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $projects = $query->orderByDesc('id')->paginate(10);

        return view('pekerja.projects.index', compact('projects', 'allProjects'));
    }


    public function myProjectShow(Project $project)
    {
        $userId = auth()->id();

        // Cek apakah pekerja mendapat assignment di project ini
        $isAssigned = $project->assignments()->where('user_id', $userId)->exists();

        if (! $isAssigned) {
            abort(403, 'You are not assigned to this project');
        }

        return view('pekerja.projects.show', compact('project'));
    }

    public function dashboard()
    {
        $user = Auth::user();

        // relasi belongsToMany → gunakan get() untuk mengambil data
        $projects = $user->projects()->get();
        $unreadCount = $user->notifications()
                    ->whereNull('notification_user.is_read')
                    ->count();


        return view('pekerja.dashboard', [
            'totalProjects'     => $projects->count(),
            'activeProjects'    => $projects->where('status', 'on_progress')->count(),
            'pendingProjects'   => $projects->where('status', 'pending')->count(),
            'completedProjects' => $projects->where('status', 'completed')->count(),
            'recentProjects'    => $projects->sortByDesc('id')->take(4),
            'unreadCount'       => $unreadCount,
        ]);
    }

}
