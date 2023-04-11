<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'project_code',
        'project_name',
        'address',
        'time_of_contract',
        'drm_value',
        'project_head_id',
        'vendor_id',
        'begin_date',
        'finish_date',
        // 'status'
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
        // 'status' => StatusEnum::class
    ];

    // Relationships
    public function projectHead()
    {
        return $this->belongsTo(User::class, 'project_head_id', 'id');
    }
    
    public function vendor()
    {
        return $this->hasOne(Vendor::class, 'id', 'vendor_id');
    }

    public function projectDesignators()
    {
        return $this->hasMany(ProjectDesignator::class, 'project_id');
    }

    public function projectEvaluations()
    {
        return $this->hasMany(ProjectEvaluation::class, 'project_id')->latest();
    }

    public function projectWorkers()
    {
        return $this->hasMany(ProjectWorker::class, 'project_id');
    }

    // Helpers
    public function progress()
    {
        return $this->projectDesignators()->count() > 0 
            ? round($this->projectDesignators->where('status', StatusEnum::Done)->count() / $this->projectDesignators->count() * 100, 2)
            : 0;
    }
}
