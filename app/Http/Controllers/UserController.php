<?php

namespace App\Http\Controllers;

use App\Models\User\Role;
use App\Models\User\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

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
            $users = User::with("roles")->get();
            if ($request->wantsJson()) {
                return new JsonResponse($users);
            } else {
                return $users;
            }
        } else {
            $roles = Role::all();
            return view('admin.user.index')->with(array(
                "roles" => $roles
            ));
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
            $roles = Role::all();
            return view('admin.user.edit')->with(array(
                "user" => $user,
                "roles" => $roles
            ));
        } catch (ModelNotFoundException $e) {
            abort(404, "Page not found");
            return false;
        }
    }

    public function update(Request $request, $user_id)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|max:255",
            "email" => "exists:users|max:255",
            "status" => "in:inactive,active,locked,deleted",
        ]);
        if ($validator->fails()) {
            $output = new \stdClass();
            $output->status = true;
            $output->errors = $validator->errors();
            if ($request->ajax()) {
                if ($request->wantsJson()) {
                    return new JsonResponse($output);
                } else {
                    return $output;
                }
            } else {
                return back()->withErrors($validator->errors())->withInput();
            }
        }
        try {
            $user = User::findOrFail($user_id);
            $user->name = $request->get("name");
            $user->status = $request->get("status");
            $user->save();
            $user->detachRoles();
            $roles = $request->get("roles");
            if (is_array($roles)) {
                foreach ($roles as $roleID) {
                    $role = Role::findOrFail($roleID);
                    $user->attachRole($role);
                }
            }
            $output = new \stdClass();
            $output->status = true;
            $output->data = array(
                "user" => $user
            );
            if ($request->ajax()) {
                if ($request->wantsJson()) {
                    return new JsonResponse($output);
                } else {
                    return $output;
                }
            } else {
                return redirect()->route("admin.user", [$user]);
            }
        } catch (ModelNotFoundException $e) {
            $output = new \stdClass();
            $output->status = true;
            $output->errors = "User not found";
            if ($request->ajax()) {
                if ($request->wantsJson()) {
                    return new JsonResponse($output);
                } else {
                    return $output;
                }
            } else {
                return back()->withErrors(array("User not found"))->withInput();
            }
        }
    }

    public function destroy(Request $request, $user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            $user->status = "deleted";
            $user->save();
            $output = new \stdClass();
            $output->status = true;
            $output->data = array(
                "user" => $user
            );
        } catch (ModelNotFoundException $e) {
            $output = new \stdClass();
            $output->status = false;
            $output->errors = array("User not found");
        } finally {
            if ($request->ajax()) {
                return new JsonResponse($output);
            } else {
                return $output;
            }
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
            if ($request->ajax()) {
                if ($request->wantsJson()) {
                    return new JsonResponse($output);
                } else {
                    return $output;
                }
            } else {
                return redirect()->route("admin.user");
            }
        } catch (ModelNotFoundException $e) {
            abort(404, "Page not found");
            return false;
        }
    }
}
