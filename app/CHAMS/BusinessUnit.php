<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: User
 * Date: 19/07/2016
 * Time: 10:21 AM
 */
class BusinessUnit extends Model
{
    protected $table = 'chams_business_units';
    protected $fillable = [
        'name',
        'description'
    ];
}