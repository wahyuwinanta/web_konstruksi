<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OwnerDashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $projects = Project::all();

        $unreadCount = $user->notifications()
                    ->whereNull('notification_user.is_read')
                    ->count();

        return view('owner.dashboard', [
            'totalProjects'     => $projects->count(),
            'activeProjects'    => $projects->where('status', 'on_progress')->count(),
            'pendingProjects'   => $projects->where('status', 'pending')->count(),
            'completedProjects' => $projects->where('status', 'completed')->count(),
            'recentProjects'    => $projects->sortByDesc('id')->take(4),
            'unreadCount'       => $unreadCount,
        ]);
    }


    public function myProjects(Request $request)
    {
        $allProjects = Project::all();
        $query = Project::query();
        $user = auth()->user();
        $search = request('search');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($search) {
        $query->where('project_name', 'LIKE', "%{$search}%");
        }
        $projects = $query->orderByDesc('id')->paginate(10);

        return view('owner.projects.index', compact('projects', 'allProjects'));
    }



    public function myProjectShow(Project $project)
    {
        $user = auth()->user();

        if ($user->role === 'worker') {
            $isAssigned = $project->assignments()->where('user_id', $user->id)->exists();

            if (! $isAssigned) {
                abort(403, 'You are not assigned to this project');
            }
        }

        // Load progress beserta images
        $progress = $project->progress()->with('images')->orderBy('created_at', 'desc')->get();

        return view('owner.projects.show', compact('project', 'progress'));
    }

    public function changeStatus(Request $request, Project $project)
    {
        // Hanya owner proyek atau user role owner
        if (Auth::id() !== $project->created_by && !Auth::user()->hasRole('owner')) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'status' => ['required', 'in:pending,on_progress,completed'],
        ]);

        $project->update([
            'status' => $validated['status']
        ]);

        return back()->with('success', 'Status proyek berhasil diubah.');
    }


}
