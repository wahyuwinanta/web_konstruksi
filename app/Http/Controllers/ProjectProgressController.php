<?php

namespace App\Http\Controllers;

use App\Models\ProjectProgress;
use App\Models\ProjectProgressImage;
use App\Models\Project;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProjectProgressController extends Controller
{
    public function store(Request $request, Project $project)
    {
        // Logging payload untuk debugging
        Log::info('FINAL DATA SIAP INSERT', [
            'project_id' => $project->id ?? null,
            'payload' => $request->all()
        ]);

        // Validasi request
        $validated = $request->validate([
            'description' => 'required|string',
            'percentage' => 'nullable|integer|min:0|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Siapkan data progress
        $progressData = [
            'project_id' => $project->id,
            'user_id' => Auth::id(),
            'progress_description' => $validated['description'],
            'progress_percentage' => $validated['percentage'] ?? null,
        ];

        // Simpan progress
        $progress = ProjectProgress::create($progressData);

        // Jika ada file image, simpan
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('progress_images', 'public');

            ProjectProgressImage::create([
                'progress_id' => $progress->id,
                'image_path' => $path
            ]);
        }

        // Kirim notifikasi ke owner proyek
        Notification::create([
            'user_id' => $project->created_by,
            'title' => 'Progress Baru Ditambahkan',
            'message' => 'Pekerja menambahkan progress pada proyek: ' . $project->project_name,
            'project_id' => $project->id,
            'is_read' => false,
        ]);

        return redirect()->route('pekerja.projects.show', $project->id)
            ->with('success', 'Progress berhasil ditambahkan');

    }

    public function show(Project $project)
    {
        $progress = ProjectProgress::where('project_id', $project->id)
            ->with('images')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pekerja.projects.show', compact('project', 'progress'));
    }

}
