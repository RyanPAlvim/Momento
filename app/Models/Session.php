<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Session extends Model
{
    protected $fillable = [
        'total_time',
        'type',
        'started_at',
        'finished_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getType()
    {
        return $this->type;
    }

    public function isFinished()
    {
        return !$this->is_null($this->finished_at);
    }

    public function isActive()
    {
        return !$this->is_null($this->started_at);
    }
}
