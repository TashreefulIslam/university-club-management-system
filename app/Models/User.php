<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

use App\Models\Attendance;
use App\Models\Certificate;
use App\Models\ClubMember;
use App\Models\EventRegistration;
use App\Models\Gallery;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const ROLE_SUPER_ADMIN = 'super_admin';

    public const ROLE_CLUB_LEADER = 'club_leader';

    public const ROLE_STUDENT = 'student';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',

        'email_verified_at',
        
        'profile_photo_path',
        'phone',
        'department',
        'batch',
        'bio',
    ];

    /**
     * The model's default values.
     *
     * @var array<string, string>
     */
    protected $attributes = [
        'role' => self::ROLE_STUDENT,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    public function isClubLeader(): bool
    {
        return $this->role === self::ROLE_CLUB_LEADER;
    }

    public function isStudent(): bool
    {
        return $this->role === self::ROLE_STUDENT;
    }

    public function roleLabel(): string
    {
        return match ($this->role) {
            self::ROLE_SUPER_ADMIN => 'Super Admin',
            self::ROLE_CLUB_LEADER => 'Club Leader',
            default => Str::headline($this->role),
        };
    }

    public function clubMemberships(): HasMany
    {
        return $this->hasMany(ClubMember::class);
    }

    public function eventRegistrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class, 'uploaded_by');
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }
}
