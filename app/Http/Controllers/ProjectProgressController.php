<?php

namespace App\Http\Controllers;

use App\Models\ProjectProgress;
use Illuminate\Http\Request;

class ProjectProgressController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'progress_description' => 'required|string',
            'progress_percentage' => 'required|integer|min:0|max:100'
        ]);

        return ProjectProgress::create([
            'project_id' => $request->project_id,
            'user_id' => auth()->id(),
            'progress_description' => $request->progress_description,
            'progress_percentage' => $request->progress_percentage,
        ]);
    }
}
