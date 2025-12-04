<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkProgress extends Model
{
    protected $table = 'work_progress';

    protected $fillable = [
        'project_id',
        'pegawai_id',
        'tanggal',
        'deskripsi',
        'persentase_progress',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'persentase_progress' => 'integer',
    ];

    /* =============================
     *            RELASI
     * ============================= */

    // Setiap progres milik 1 proyek
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Setiap progres dibuat oleh 1 pegawai
    public function pegawai()
    {
        return $this->belongsTo(User::class, 'pegawai_id');
    }
}
