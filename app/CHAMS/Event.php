<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: User
 * Date: 19/07/2016
 * Time: 10:20 AM
 */
class Event extends Model
{
    protected $table = 'chams_events';
    protected $fillable = [
        'name',
        'location',
        'start_date_time',
        'end_date_time',
    ];
}