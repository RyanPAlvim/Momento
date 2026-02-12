<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Enums\GroupStatus;

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

    public function friendsRequested()
    {
        return $this->belongsToMany(User::class, 'friendship', 'user_id', 'friend_id')->using(Friendship::class)
            ->withPivot('status');
    }

    public function friendsOf()
    {
        return $this->belongsToMany(User::class, 'friendship', 'friend_id', 'user_id')->using(Friendship::class)
            ->withPivot('status');
    }

    public function acceptedFriendsOf()
    {
        return $this->friendsOf()->wherePivot('status', 'accepted');
    }

    public function acceptedFriendsRequested()
    {
        return $this->friendsRequested()->wherePivot('status', 'accepted');
    }


    public function getAllAcceptedFriends()
    {
        return $this->acceptedFriendsOf()->get()->merge($this->acceptedFriendsRequested()->get());
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_relations', 'user_id', 'group_id')->using(GroupRelations::class)->withPivot('status');
    }

    public function pendingGroups()
    {
        return $this->groups()->wherePivot('status', GroupStatus::PENDING);
    }

    public function acceptedGroups()
    {
        return $this->groups()->wherePivotIn('status', [GroupStatus::MEMBER, GroupStatus::ADMIN]);
    }

    public function managedGroups()
    {
        return $this->groups()->wherePivot('status', GroupStatus::ADMIN);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class, 'user_id', 'id');
    }

    public function finishedSessions()
    {
        return $this->sessions()->whereNotNull('finished_at');
    }

    public function goalCompletitions()
    {
        return $this->hasMany(GoalCompletition::class, 'user_id', 'id');
    }
}
