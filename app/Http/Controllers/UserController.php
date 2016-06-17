<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
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
            return view('admin.user.index');
        }
    }

    public function create(Request $request)
    {
        abort(404, "Page not found");
        return false;
    }

    public function store()
    {
        abort(404, "Page not found");
        return false;
    }

    public function show($user_id)
    {

    }

    public function edit($user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            return view('admin.user.edit')->with(array(
                "user" => $user,
            ));
        } catch (ModelNotFoundException $e) {
            abort(404, "Page not found");
            return false;
        }
    }

    public function update(Request $request, $user_id)
    {

    }

    public function destroy(Request $request, $user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            $user->status = "deleted";
            $user->save();
            $output = array(
                "status" => true,
                "data" => array(
                    "user" => $user
                )
            );
            if ($request->json()) {
                return response()->json($output);
            } else {
                return $output;
            }
        } catch (ModelNotFoundException $e) {
            abort(404, "Page not found");
            return false;
        }
    }

    public function revive(Request $request, $user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            $user->status = "inactive";
            $user->save();
            $output = array(
                "status" => array(
                    "user" => $user
                )
            );
            if ($request->json()) {
                return response()->json($output);
            } else {
                return $output;
            }
        } catch (ModelNotFoundException $e) {
            abort(404, "Page not found");
            return false;
        }
    }
}
