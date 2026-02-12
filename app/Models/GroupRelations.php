<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupRelations extends Pivot
{
    protected $table = 'group_relations';
    public $timestamps = true;

    protected $fillable = [
        'status',
        'user_id',
        'group_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
}
