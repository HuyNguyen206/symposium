<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Conference extends Model
{
    use HasFactory;

    public function favoritedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}
