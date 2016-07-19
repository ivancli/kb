<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: User
 * Date: 19/07/2016
 * Time: 10:19 AM
 */
class Asset extends Model
{
    protected $table = 'chams_assets';
    protected $fillable = [
        'name',
        'asset_number',
        'valid_from',
        'valid_to',
        'returned',
        'fulfilled',
        'given_out_time',
    ];
}