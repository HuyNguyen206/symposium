<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function talks()
    {
        return $this->hasMany(Talk::class);
    }

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

    public function favoritedConferences(): BelongsToMany
    {
        return $this->belongsToMany(Conference::class, 'favorites');
    }

    public function isLikeThisConf(Conference $conference): bool
    {
//        return $conference->favoritedUsers()->where('favorites.user_id', $this->id)->exists();
        return $this->favoritedConferences()->where('favorites.conference_id',$conference->id)->exists();
//        return $this->favoritedConferences->pluck('id')->contains($conference->id);
    }
}
