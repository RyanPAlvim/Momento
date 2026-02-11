<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Friendship extends Pivot
{
    protected $table = 'friendships';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'friend_id',
        'status',
    ];

    protected function sender() {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function recipient() {
        return $this->belongsTo(User::class, 'friend_id');
    }
}
