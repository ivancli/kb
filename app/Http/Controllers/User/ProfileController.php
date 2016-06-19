<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 19/06/2016
 * Time: 2:58 PM
 */
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        if ($request->ajax()) {
            if ($request->wantsJson()) {
                return new JsonResponse($user);
            } else {
                return $user;
            }
        } else {
            return view('user.profile.index')->with(array(
                "user" => $user
            ));
        }
    }

    public function show(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            /* TODO need to handle private permission settings here*/
            if ($request->ajax()) {
                if ($request->wantsJson()) {
                    return new JsonResponse($user);
                } else {
                    return $user;
                }
            } else {
                return view('user.profile.index')->with(array(
                    "user" => $user
                ));
            }
        } catch (ModelNotFoundException $e) {
            $output = new \stdClass();
            $output->status = false;
            $output->error = "User not found";
            if ($request->ajax()) {
                if ($request->wantsJson()) {
                    return new JsonResponse($output);
                } else {
                    return $output;
                }
            } else {
                abort(404, "Page not found");
                return false;
            }
        }
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.profile.edit')->with(array(
            "user" => $user
        ));
    }

    public function update()
    {

    }
}