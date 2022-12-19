<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDesignatorProgressUpdate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'project_designator_id',
        'content',
        'type',
        'value',
        'description',
        'comment',
        'commented_by',
        'status',
        'uploaded_by',
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

    protected $appends = [
        'status_color', 'icon', 'commented_by_name'
    ];

    // Attributes
    public function getStatusColorAttribute()
    {
        return $this->status->color();
    }

    public function getIconAttribute()
    {
        return $this->status->icon();
    }

    public function getCommentedByNameAttribute()
    {
        return $this->commentedBy?->name;
    }

    // Relationships
    public function projectDesignator()
    {
        return $this->belongsTo(ProjectDesignator::class, 'project_designator_id', 'id');
    }

    public function commentedBy()
    {
        return $this->belongsTo(User::class, 'commented_by', 'id');
    }
    
    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by', 'id');
    }
}
