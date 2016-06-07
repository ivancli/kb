<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:kb_admin');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::all();
            if ($request->json()) {
                return new JsonResponse($users);
            } else {
                return $users;
            }
        } else {
            return view('user.index');
        }
    }

    public function create(Request $request)
    {

    }

    public function store()
    {

    }

    public function show($user_id)
    {

    }

    public function edit($user_id)
    {

    }

    public function update(Request $request, $user_id)
    {

    }

    public function destroy($user_id)
    {

    }
}
