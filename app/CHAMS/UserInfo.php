<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 19/07/2016
 * Time: 1:45 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class StaffInfo extends Model
{
    protected $primaryKey = 'user_id';
    protected $table = 'chams_user_info';
    protected $fillable = [
        'staff_id',
        'telephone',
        'job_title',
        'department',
        'staff_cost_centre',
        'salesforce_id',
        'client_title',
        'client_business',
    ];
}