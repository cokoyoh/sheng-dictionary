<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar_url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }

    public function addSocialAccount(array $attributes)
    {
        return $this->socialAccounts()->create($attributes);
    }

    public function words()
    {
        return $this->hasMany(Word::class);
    }

    public function addWord(array $attributes)
    {
        return $this->words()->create($attributes);
    }

    public function getAvatarAttribute()
    {
        return $this->avatar_url;
    }

    public function getVoteFor($word)
    {
        $like = $word->likes()->where('user_id', $this->id)->exists(); //scope

        if ($like) {
            return 'like';
        }

        $dislike = $word->dislikes()->where('user_id', $this->id)->exists();

        if ($dislike) {
            return 'dislike';
        }

        return null;
    }
}
