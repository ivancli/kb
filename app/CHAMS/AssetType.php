<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: User
 * Date: 19/07/2016
 * Time: 10:19 AM
 */
class AssetType extends Model
{
    protected $table = 'chams_asset_types';
    protected $fillable = [
        'name',
        'persons_allowed',
        'guest_name_required',
        'booking_form_type',
        'meal_cost',
        'meal_recovery',
        'non_meal_cost',
        'returnable',
        'return_days',
        'is_private',
        'box_office',
        'email_confirm',
    ];
}