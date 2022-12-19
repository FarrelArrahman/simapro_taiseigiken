<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDesignator extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'project_id',
        'designator_id',
        'designated_by',
        'amount',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => StatusEnum::class
    ];

    // Relationships
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function designator()
    {
        return $this->belongsTo(Designator::class, 'designator_id', 'id');
    }

    public function projectDesignatorProgressUpdates()
    {
        return $this->hasMany(ProjectDesignatorProgressUpdate::class, 'project_designator_id')->latest();
    }

    public function realization()
    {
        return $this->projectDesignatorProgressUpdates->sum('value');
    }
}
