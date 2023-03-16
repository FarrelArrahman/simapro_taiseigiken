<?php

namespace App\Models;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'national_identity_number',
        'name',
        'email',
        'password',
        'gender',
        'address',
        'phone_number',
        'role',
        'status',
        'profile_picture',
        'locale'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => RoleEnum::class,
        'status' => StatusEnum::class
    ];

    // Helpers
    public function headedProjects()
    {
        return $this->hasMany(Project::class, 'project_head_id');
    }

    public function workedProjects()
    {
        return $this->hasManyThrough(
            Project::class,
            ProjectWorker::class,
            'user_id',
            'id',
            'id',
            'id'
        );
    }

    public function projectWorkers()
    {
        return $this->hasMany(ProjectWorker::class, 'user_id');
    }

    public function ongoingHeadedProjects()
    {
        $headedProjects = $this->headedProjects;
        return collect($headedProjects)->filter(function($item) {
            return $item->progress() < 100;
        });
    }


    public function ongoingWorkedProjects()
    {
        $workedProjects = $this->workedProjects;
        return collect($workedProjects)->filter(function($item) {
            return $item->progress() < 100;
        });
    }
}
