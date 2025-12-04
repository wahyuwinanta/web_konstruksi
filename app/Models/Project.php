<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'project_name',
        'description',
        'start_date',
        'end_date',
        'status',
        'created_by',
        'approved_by',
    ];

    protected $casts = [
    'start_date' => 'date',
    'end_date' => 'date',
    ];


    public function assignments()
    {
        return $this->hasMany(ProjectAssignment::class);
    }

    public function progress()
    {
        return $this->hasMany(ProjectProgress::class);
    }
    
}



