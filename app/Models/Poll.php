<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_public',
        'user_id',
    ];


    public function options(): hasMany
    {
        return $this->hasMany(Option::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function isAlreadySubmitted($userId): bool
    {
        return $this->votes()->where('user_id', $userId)->exists();
    }
}


