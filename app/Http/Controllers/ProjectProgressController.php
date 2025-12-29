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
        Log::info('FINAL DATA SIAP INSERT', [
            'project_id' => $project->id ?? null,
            'payload' => $request->all()
        ]);

        // 1. Validasi dasar
        $validated = $request->validate([
            'description' => 'required|string',
            'percentage' => 'nullable|integer|min:0|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // 2. Ambil progress terakhir (state sebelumnya)
        $lastPercentage = ProjectProgress::where('project_id', $project->id)
            ->orderBy('created_at', 'desc')
            ->value('progress_percentage') ?? 0;

        // 3. Tentukan progress baru
        $newPercentage = $validated['percentage'] ?? $lastPercentage;

        // 4. Cegah progress mundur
        if ($newPercentage < $lastPercentage) {
            return back()
                ->withErrors([
                    'percentage' => "Progress tidak boleh lebih kecil dari progress sebelumnya ({$lastPercentage}%)"
                ])
                ->withInput();
        }

        // 5. Simpan progress
        $progress = ProjectProgress::create([
            'project_id' => $project->id,
            'user_id' => Auth::id(),
            'progress_description' => $validated['description'],
            'progress_percentage' => $newPercentage,
        ]);

        // 6. Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('progress_images', config('filesystems.default_public_disk'));

            ProjectProgressImage::create([
                'progress_id' => $progress->id,
                'image_path' => $path
            ]);
        }

        // 7. Notifikasi pimpinan proyek
        Notification::create([
            'user_id' => $project->created_by,
            'title' => 'Progress Baru Ditambahkan',
            'message' => 'Pegawai menambahkan progress pada proyek: ' . $project->project_name,
            'project_id' => $project->id,
            'is_read' => false,
        ]);

        return redirect()
            ->route('pegawai.projects.show', $project->id)
            ->with('success', 'Progress berhasil ditambahkan');
    }


    public function show(Project $project)
    {
        $progress = ProjectProgress::where('project_id', $project->id)
            ->with('images')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pegawai.projects.show', compact('project', 'progress'));
    }

}
