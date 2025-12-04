<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'evaluations';

    protected $fillable = [
        'project_id',
        'owner_id',
        'rating',
        'komentar',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    /* =============================
     *            RELASI
     * ============================= */

    // Evaluasi diberikan untuk 1 proyek
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Evaluasi dibuat oleh owner
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
