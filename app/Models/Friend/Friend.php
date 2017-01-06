<?php

namespace App\Models\Friend;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user1_id', 'user2_id', 'status',
    ];

    protected $appends = [
        'friendOfLoggedInUser',
    ];

    /**
     * Friend of user2
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user1()
    {
        return $this->belongsTo('App\Models\User\User', 'user1_id');
    }

    /**
     * Friend of user1
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user2()
    {
        return $this->belongsTo('App\Models\User\User', 'user2_id');
    }

    /**
     * Relationship between user1 and user2
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function relationship()
    {
        return $this->hasOne('App\Models\Friend\FriendRelationship', 'friend_id');
    }

    public function friendOf($user_id)
    {
        if ($this->user1->getKey() == $user_id) {
            return $this->user2;
        } else {
            return $this->user1;
        }
    }

    /*Attributes*/

    /**
     * Get the friend User of logged in user
     * @return mixed|null
     */
    public function getFriendOfLoggedInUserAttribute()
    {
        if (auth()->check()) {
            return $this->friendOf(auth()->user()->getKey());
        } else {
            return null;
        }
    }
}