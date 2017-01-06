<?php

namespace App\Models\User;

use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmation_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function info()
    {
        return $this->hasOne('App\Models\User\UserInfo');
    }

    public function pref()
    {
        return $this->hasOne('App\Models\User\UserPref');
    }

    /**
     * All friends of logged in user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function friends()
    {
        return $this->hasMany('App\Models\Friend\Friend', 'user1_id')->orWhere('user2_id', $this->getKey());
    }

    /**
     * Requests sent by logged in user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sentRequests()
    {
        return $this->hasMany('App\Models\Friend\FriendRequest', 'requester_id');
    }

    /**
     * Requests received by logged in user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receivedRequests()
    {
        return $this->hasMany('App\Models\Friend\FriendRequest', 'requestee_id');
    }

    public static function chams()
    {
        return User::whereHas("roles", function ($query) {
            $query->where("name", "like", "chams%");
        })->get();
    }
}
