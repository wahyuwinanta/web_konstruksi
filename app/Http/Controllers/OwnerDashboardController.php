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

        if ($request->status) {
            $query->where('status', $request->status);
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

        return view('owner.projects.show', compact('project'));
    }


}
