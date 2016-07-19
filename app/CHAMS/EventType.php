<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: User
 * Date: 19/07/2016
 * Time: 10:20 AM
 */
class EventType extends Model
{
    protected $table = 'chams_event_types';
    protected $fillable = [
        'name',
    ];
}