<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\GroupStatus;

class Group extends Model
{

    protected $fillable = [
        'name',
        'description',
        'group_pic_path',
        'accepted_activities',
        'secondary_activity_type',
        'group_type'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_relations', 'group_id', 'user_id')->using(GroupRelations::class)->withPivot('status');
    }

    public function admins()
    {
        return $this->users()->wherePivot('status', GroupStatus::ADMIN);
    }

    public function containsUser(User $user)
    {
        return $this->users()->contains($user);
    }
}
