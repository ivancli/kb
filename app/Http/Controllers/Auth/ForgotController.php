<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 4/06/2016
 * Time: 5:30 PM
 */

namespace App\Http\Controllers\Auth;

use App\Models\User\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotController extends Controller
{
    function viewReset($encrypted_email, $confirmation_code)
    {
        try {
            $email = Crypt::decrypt($encrypted_email);
        } catch (DecryptException $e) {
            abort(403, "Unauthorised access");
            return false;
        }
        $data = array(
            "email" => $email,
            "confirmation_code" => $confirmation_code,
        );
        $validator = Validator::make($data, [
            'email' => 'required|email|exists:users'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user = User::whereEmail($email)->firstOrFail();
        if ($user) {
            if ($user->confirmation_code == $confirmation_code) {
                return view('auth/reset')->with(array(
                    'encrypted_email' => $encrypted_email,
                    'confirmation_code' => $confirmation_code
                ));
            }
        }
        abort(403, "Unauthorised access");
        return false;
    }

    function postReset(Request $request)
    {
        Log::info("ForgotController.php postReset called.");
        try {
            $email = Crypt::decrypt($request->get('encrypted_email'));
        } catch (DecryptException $e) {
            abort(403, "Unauthorised access");
            return false;
        }
        $data = array(
            "email" => $email,
            "confirmation_code" => $request->get('confirmation_code'),
            "password" => $request->get('password'),
            "password_confirmation" => $request->get('password_confirmation'),
        );
        $validator = Validator::make($data, [
            'email' => 'required|email|exists:users',
            'confirmation_code' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            if ($request->json()) {
                return new JsonResponse($validator->errors()->getMessages(), 422);
            } else {
                return redirect()->back()->withErrors($validator);
            }
        }
        $user = User::whereEmail($email)->firstOrFail();
        if($user){
            if($user->confirmation_code = $request->get('confirmation_code')){
                $user->password = bcrypt($request->get('password'));
                $user->confirmation_code = null;
                $user->save();

                $output = new \stdClass();
                $output->status = true;
                $output->responseText = "You password has been updated successfully.";
                if ($request->json()) {
                    return new JsonResponse($output);
                } else {
                    return redirect('/');
                }
            }else{
                Log::info("ForgotController.php postReset confirmation_code not match: " . $request->get('email'));
            }
        }else{
            Log::info("ForgotController.php postReset user not found: " . $request->get('email'));
        }
        abort(403, "Unauthorised access");
        return false;
    }

    public function postForgot(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users'
        ]);

        if ($validator->fails()) {
            if ($request->json()) {
                return new JsonResponse($validator->errors()->getMessages(), 422);
            } else {
                return redirect()->back()->withErrors($validator);
            }
        }

        $user = User::whereEmail($request->get('email'))->firstOrFail();
        if ($user) {
            $confirmationCode = str_random(30);
            $user->confirmation_code = $confirmationCode;
            $user->save();

            Mail::send('emails.auth.reset', array(
                "confirmation_code" => $confirmationCode,
                "email" => Crypt::encrypt($request->get('email')),
            ), function ($message) {
                $message->to(Input::get('email'), 'ICL KB user')
                    ->subject('Reset password');
            });
            $output = new \stdClass();
            $output->status = true;
            $output->responseText = "An email has been sent to your mailbox.";
            return new JsonResponse($output);
        } else {
            if ($request->json()) {
                return new JsonResponse(array("email" => "Unable to proceed. Please contact Ivan for more details."), 422);
            } else {
                return redirect()->back()->withErrors($validator);
            }
        }

    }
}