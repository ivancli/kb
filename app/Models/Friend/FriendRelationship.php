<?php

namespace App\Models\Friend;

use Illuminate\Database\Eloquent\Model;

class FriendRelationship extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'friend_id', 'content',
    ];

    /**
     * Friendship of this relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function friend()
    {
        return $this->belongsTo('App\Models\Friend\Friend', 'friend_id');
    }
}
