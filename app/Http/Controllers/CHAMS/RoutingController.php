<?php
namespace App\Http\Controllers\CHAMS;

use App\Models\User\User;
use Illuminate\Routing\Controller;

/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 5/06/2016
 * Time: 10:25 PM
 */
class RoutingController extends Controller
{
    public function home()
    {
        return view('chams.home');
    }

    public function users()
    {
        $users = User::chams();
        return view('chams.users')->with(array(
            "users" => $users
        ));
    }

    public function businessUnits()
    {
        return view('chams.business_units');
    }

    public function assets()
    {
        return view('chams.assets');
    }

    public function events()
    {
        return view('chams.events');
    }

    public function bookings()
    {
        return view('chams.bookings');
    }

    public function reports()
    {
        return view('chams.reports');
    }
}