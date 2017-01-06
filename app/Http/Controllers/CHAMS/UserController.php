<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 19/07/2016
 * Time: 5:00 PM
 */

namespace App\Http\Controllers\CHAMS;


use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function __construct()
    {

    }

    public function index(Request $request)
    {
        $users = User::chams();
        if ($request->ajax()) {
            if ($request->wantsJson()) {
                return new JsonResponse($users);
            } else {
                return $users;
            }
        } else {
            return view('chams.users')->with(array(
                "users" => $users
            ));
        }
    }

    public function create(Request $request)
    {
        
    }

    public function store(Request $request)
    {

    }

    public function edit(Request $request)
    {

    }

    public function update(Request $request)
    {

    }

    public function destroy(Request $request)
    {

    }
}