<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $search = request('search');

        if ($user->hasAnyRole(['super_admin', 'owner'])) {
            $projects = Project::query()
                ->when($search, fn($q) => $q->where('project_name', 'like', "%{$search}%"))
                ->orderByDesc('id')
                ->paginate(10);
        } elseif ($user->hasRole('pekerja')) {
            $projects = Project::whereHas('assignments', fn($q) => $q->where('user_id', $user->id))
                ->when($search, fn($q) => $q->where('project_name', 'like', "%{$search}%"))
                ->orderByDesc('id')
                ->paginate(10);
        } else {
            $projects = Project::where('id', 0)->paginate(10);
        }

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = User::role('pekerja')->where('is_active', 1)->get();
        return view('admin.projects.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_name'   => 'required|string|max:255',
            'description'    => 'nullable|string',
            'location'       => 'nullable|string|max:255',
            'project_type'   => 'nullable|string|max:100',
            'start_date'     => 'required|date',
            'end_date'       => 'nullable|date|after_or_equal:start_date',
            'status'         => 'required|in:pending,on_progress,completed',
            'estimated_cost' => 'nullable|numeric|min:0',
            'rab_file'       => 'nullable|file|mimes:pdf,doc,docx',
            'design_file'    => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'employees'      => 'nullable|array',
            'employees.*'    => 'exists:users,id',
        ]);

        DB::transaction(function () use ($validated, $request) {
            // Upload files jika ada
            if ($request->hasFile('rab_file')) {
                $validated['rab_file'] = $request->file('rab_file')->store('projects/rab', 'public');
            }
            if ($request->hasFile('design_file')) {
                $validated['design_file'] = $request->file('design_file')->store('projects/designs', 'public');
            }

            $project = Project::create([
                'project_name'   => $validated['project_name'],
                'description'    => $validated['description'] ?? null,
                'location'       => $validated['location'] ?? null,
                'project_type'   => $validated['project_type'] ?? null,
                'start_date'     => $validated['start_date'],
                'end_date'       => $validated['end_date'] ?? null,
                'status'         => $validated['status'],
                'estimated_cost' => $validated['estimated_cost'] ?? null,
                'rab_file'       => $validated['rab_file'] ?? null,
                'design_file'    => $validated['design_file'] ?? null,
                'created_by'     => Auth::id(),
                'approved_by'    => $validated['approved_by'] ?? null,
            ]);

            // Assign pegawai jika ada
            if (!empty($validated['employees'])) {
                foreach ($validated['employees'] as $user_id) {
                    ProjectAssignment::create([
                        'project_id'       => $project->id,
                        'user_id'          => $user_id,
                        'assigned_date'    => now(),
                        'task_description' => null,
                    ]);
                }
            }

            // Kirim notifikasi ke owner & assigned employees
            $ownerIds = User::role('owner')->pluck('id')->toArray();
            $assignedEmployees = $validated['employees'] ?? [];
            $targetUsers = array_unique(array_merge($ownerIds, $assignedEmployees));

            foreach ($targetUsers as $uid) {
                Notification::create([
                    'user_id'    => $uid,
                    'title'      => 'Proyek Baru Ditambahkan',
                    'message'    => "Proyek '{$project->project_name}' baru saja dibuat.",
                    'project_id' => $project->id,
                    'is_read'    => false,
                ]);
            }
        });

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $employees = User::role('pekerja')->where('is_active', 1)->get();
        $assignedEmployees = $project->assignments()->pluck('user_id')->toArray();

        return view('admin.projects.edit', compact('project', 'employees', 'assignedEmployees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'project_name'   => 'sometimes|string|max:255',
            'description'    => 'nullable|string',
            'location'       => 'nullable|string|max:255',
            'project_type'   => 'nullable|string|max:100',
            'start_date'     => 'sometimes|date',
            'end_date'       => 'nullable|date|after_or_equal:start_date',
            'status'         => 'in:pending,on_progress,completed',
            'estimated_cost' => 'nullable|numeric|min:0',
            'rab_file'       => 'nullable|file|mimes:pdf,doc,docx',
            'design_file'    => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'employees'      => 'nullable|array',
            'employees.*'    => 'integer|exists:users,id',
        ]);

        DB::transaction(function () use ($validated, $project, $request) {
            // Upload file baru jika ada
            if ($request->hasFile('rab_file')) {
                if ($project->rab_file) Storage::disk('public')->delete($project->rab_file);
                $validated['rab_file'] = $request->file('rab_file')->store('projects/rab', 'public');
            }
            if ($request->hasFile('design_file')) {
                if ($project->design_file) Storage::disk('public')->delete($project->design_file);
                $validated['design_file'] = $request->file('design_file')->store('projects/designs', 'public');
            }
            $oldEmployees = $project->assignments()->pluck('user_id')->toArray();
            $newEmployees = $validated['employees'] ?? [];
            $addedEmployees = array_diff($newEmployees, $oldEmployees);
            $project->update($validated);

            // Update assignments
            if (isset($validated['employees'])) {
                $project->assignments()->delete();
                foreach ($validated['employees'] as $user_id) {
                    ProjectAssignment::create([
                        'project_id'    => $project->id,
                        'user_id'       => $user_id,
                        'assigned_date' => now(),
                    ]);
                }
            }
                foreach ($addedEmployees as $uid) {
                Notification::create([
                    'user_id'    => $uid,
                    'title'      => 'Penugasan Baru pada Proyek',
                    'message'    => "Anda baru saja ditugaskan ke proyek '{$project->project_name}'.",
                    'project_id' => $project->id,
                    'is_read'    => false,
                ]);
            }
        });

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project archived successfully.');
    }

    // Tambahan metode untuk pekerja, dashboard, dan detail proyek
    public function myProjects(Request $request)
    {
        $userId = auth()->id();
        $search = request('search');

        $query = Project::whereHas('assignments', fn($q) => $q->where('user_id', $userId));

        if ($request->status) $query->where('status', $request->status);
        if ($search) $query->where('project_name', 'LIKE', "%{$search}%");

        $projects = $query->orderByDesc('id')->paginate(10);
        $allProjects = $query->get();

        return view('pekerja.projects.index', compact('projects', 'allProjects'));
    }

    public function myProjectShow(Project $project)
    {
        $userId = auth()->id();
        $isAssigned = $project->assignments()->where('user_id', $userId)->exists();
        if (!$isAssigned) abort(403, 'You are not assigned to this project');

        // Load progress beserta images
        $progress = $project->progress()->with('images')->orderBy('created_at', 'desc')->get();

        return view('pekerja.projects.show', compact('project', 'progress'));
    }


    public function dashboard()
    {
        $user = Auth::user();
        $projects = $user->projects()->get();
        $unreadCount = $user->notifications()->whereNull('notification_user.is_read')->count();

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
