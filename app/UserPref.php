<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 30/06/2016
 * Time: 10:33 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class UserPref extends Model
{
    protected $table = 'user_pref';
    protected $fillable = [
        "profile_view",
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}