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
        'location',
        'project_type',
        'product_id',
        'start_date',
        'end_date',
        'estimated_cost',
        'rab_file',
        'design_file',
        'status',
        'created_by',
        'approved_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'estimated_cost' => 'decimal:2'
    ];

    public function assignments()
    {
        return $this->hasMany(ProjectAssignment::class);
    }

    public function progress()
    {
        return $this->hasMany(ProjectProgress::class);
    }

    public function workers()
    {
        return $this->belongsToMany(User::class, 'project_workers');
    }

    public function notes()
    {
        return $this->hasMany(ProjectNote::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
