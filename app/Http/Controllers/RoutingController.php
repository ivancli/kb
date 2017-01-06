<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 22/05/2016
 * Time: 7:57 PM
 */

namespace App\Http\Controllers;


use App\Models\Friend\Friend;
use App\Models\User\User;

class RoutingController extends Controller
{
    function home()
    {
        return view('home');
    }

    function login()
    {
        return view('auth/login');
    }
}