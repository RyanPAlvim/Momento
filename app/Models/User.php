<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'phone',
        'weekly_day_goals',
        'daily_minutes_goal',
        'profile_picture_path',
        'is_private',
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

    public function friendsRequested() {
        return $this->belongsToMany(User::class, 'friendship', 'user_id', 'friend_id')
        ->withPivot('status');
    }

    public function friendsOf(){
        return $this->belongsToMany(User::class, 'friendship', 'friend_id', 'user_id')
        ->withPivot('status');
    }

    public function getAllFriends(){
        return $this->friendsRequested()->merge($this->friendsOf());
    }

    public function getAllAcceptedFriends() {
        return $this->getAllFriends()->wherePivot('status', 'accepted');
    }
}
