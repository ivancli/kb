<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 29/06/2016
 * Time: 9:04 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $primaryKey = 'user_id';
    protected $table = 'user_info';
    protected $fillable = [
        "title",
        "description",
        "dob",
        "gender",
        "phone",
        "suburb",
        "state",
        "country",
        "profile_pic",
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}