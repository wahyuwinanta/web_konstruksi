<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectProgress extends Model
{
    protected $table = 'project_progress';

    protected $fillable = [
        'project_id',
        'user_id',
        'progress_description',
        'progress_percentage',
    ];

    public function images()
    {
        return $this->hasMany(ProjectProgressImage::class, 'progress_id');
    }

    

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


// --------------------
// Model Anak (Tetap 1 File)
// --------------------

class ProjectProgressImage extends Model
{
    protected $table = 'project_progress_images';

    protected $fillable = [
        'progress_id',
        'image_path'
    ];

    public function progress()
    {
        return $this->belongsTo(ProjectProgress::class, 'progress_id');
    }
}

