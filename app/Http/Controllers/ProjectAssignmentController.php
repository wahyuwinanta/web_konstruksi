<?php

namespace App\Http\Controllers;

use App\Models\ProjectAssignment;
use Illuminate\Http\Request;

class ProjectAssignmentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
            'assigned_date' => 'required|date',
            'task_description' => 'nullable|string'
        ]);

        $data = $request->only(['project_id', 'user_id', 'assigned_date', 'task_description']);
        return ProjectAssignment::create($data);

    }

    public function destroy($id)
    {
        $assignment = ProjectAssignment::findOrFail($id);
        $assignment->delete();

        return response()->json([
            'message' => 'Assignment removed',
            'id' => $id
        ]);
    }

}
