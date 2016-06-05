<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 4/06/2016
 * Time: 4:06 PM
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class VerifyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function verify($confirmationCode)
    {
        if (!$confirmationCode || !Auth::check()) {
            return App::abort(403, 'Unauthorized action.');
        }
        $user = Auth::user();
        if ($user->status != 'inactive') {
            switch ($user->status) {
                case "active":
                    $msg = "Your account has already been activated.";
                    break;
                case "locked":
                    $msg = "Your account is locked. Please contact support for more information.";
                    break;
                default:
                    $msg = 'No action is taken';
                    break;
            }
            return view('auth/verify')->with(array(
                'msgHeading' => 'Activation',
                'msg' => $msg,
            ));
        } elseif ($user->confirmation_code != $confirmationCode) {
            echo "<pre>";
            print_r($user->confirmation_code);
            print_r($confirmationCode);
            echo "</pre>";
            exit();
            return App::abort(403, 'Unauthorized action.');
        } else {
            $user->confirmation_code = NULL;
            $user->status = "active";
            $user->save();
            return view('auth/verify')->with(array(
                'msgHeading' => 'Activation',
                'msg' => 'Your account is now activated.',
            ));
        }
    }
}