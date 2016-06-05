<?php
namespace App\Http\Controllers\CHAMS;

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
        return view('chams.users');
    }
}