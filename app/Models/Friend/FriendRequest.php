<?php

namespace App\Models\Friend;

use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'requester_id', 'requestee_id', 'status',
    ];

    /**
     * The user who sent the request
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function requester()
    {
        return $this->belongsTo('App\Models\User\User', 'requester_id');
    }

    /**
     * The user who received the request
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function requestee()
    {
        return $this->belongsTo('App\Models\User\User', 'requestee_id');
    }
}
