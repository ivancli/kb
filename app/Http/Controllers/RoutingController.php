<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 22/05/2016
 * Time: 7:57 PM
 */

namespace App\Http\Controllers;


class RoutingController extends Controller
{
    function home()
    {
        return view('home');
    }

    function login()
    {
        return view('login');
    }

    function registerSuccess()
    {
        return view('login');
    }
}