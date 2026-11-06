<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Club extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_name',
        'description',
        'mission',
        'logo',
        'banner',
        'advisor_id',
        'category',
        'status',
    ];

    public function advisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'advisor_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(ClubMember::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }
}