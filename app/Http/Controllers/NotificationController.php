<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Project;
use App\Models\ProjectAssignment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    // GET /notifications?order=fifo|lifo
    public function index(Request $request)
    {
        $order = $request->order === 'fifo' ? 'asc' : 'desc';

        $notifications = Notification::where('user_id', auth()->id())
            ->orderBy('created_at', $order)
            ->paginate(10);

        $view = auth()->user()->hasRole('pimpinan')
            ? 'pimpinan.notifications'
            : 'pegawai.notifications';

        return view($view, compact('notifications'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'description'  => 'nullable|string',
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'status'       => 'required|in:pending,on_progress,completed',
            'approved_by'  => 'nullable|integer',
            'employees'    => 'nullable|array',
            'employees.*'  => 'exists:users,id',
        ]);

        DB::transaction(function () use ($validated) {

            // CREATE PROJECT
            $project = Project::create([
                'project_name' => $validated['project_name'],
                'description'  => $validated['description'] ?? null,
                'start_date'   => $validated['start_date'],
                'end_date'     => $validated['end_date'] ?? null,
                'status'       => $validated['status'],
                'created_by'   => Auth::id(),
                'approved_by'  => $validated['approved_by'] ?? null,
            ]);

            // ASSIGN WORKERS
            $assignedEmployees = [];
            if (!empty($validated['employees'])) {
                foreach ($validated['employees'] as $user_id) {
                    ProjectAssignment::create([
                        'project_id'    => $project->id,
                        'user_id'       => $user_id,
                        'assigned_date' => now(),
                    ]);
                    $assignedEmployees[] = $user_id;
                }
            }

            // ALL pimpinanS MUST RECEIVE NOTIF
            $pimpinanIds = User::role('pimpinan')->pluck('id')->toArray();

            // Unique users only
            $targetUsers = array_unique(array_merge($pimpinanIds, $assignedEmployees));

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

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully and notifications sent.');
    }


    public function markAsRead($id)
    {
        $notif = Notification::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $notif->update(['is_read' => true]);

        return back()->with('success', 'Notifikasi ditandai sebagai dibaca');
    }


    public function open($id)
    {
        $notif = Notification::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if (!$notif->is_read) {
            $notif->update(['is_read' => true]);
        }

        $user = auth()->user();
        $ispimpinan = $user->hasRole('pimpinan');

        // Notification related to project
        if ($notif->project_id) {
            $project = Project::find($notif->project_id);

            if ($project) {
                $routeName = $ispimpinan
                    ? 'pimpinan.projects.show'
                    : 'pegawai.projects.show';

                return redirect()->route($routeName, $project->id);
            }

            $fallback = $ispimpinan ? 'pimpinan.notifications' : 'pegawai.notifications';

            return redirect()->route($fallback)
                ->with('error', 'Proyek yang dimaksud sudah dihapus.');
        }

        // Manual link
        if (!empty($notif->link)) {
            return redirect()->to($notif->link);
        }

        // Default fallback
        $fallback = $ispimpinan ? 'pimpinan.notifications' : 'pegawai.notifications';
        return redirect()->route($fallback);
    }

    public function markAllRead()
    {
        Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }

}
