<?php

namespace App\Http\Controllers\Auth;

use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\JsonResponse;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $loginPath = 'login';
    protected $username = 'email';
    protected $redirectAfterLogout = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * override login process by adding status validation
     *
     * @param Request $request
     * @return AuthController|\Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        $credentials = $this->getCredentials($request);
        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            if (Auth::check() && (Auth::user()->status == "locked" || Auth::user()->status == "deleted")) {
                $this->fireLockoutEvent($request);
                Auth::guard($this->getGuard())->logout();
                $output = new \stdClass();
                $output->status = false;
                $output->responseJSON = array(
                    "Your account is locked out. Please contact Ivan for more information."
                );
                if ($request->ajax()) {
                    if ($request->wantsJson()) {
                        return new JsonResponse($output);
                    } else {
                        return $output;
                    }
                } else {
                    return $this->sendLockoutResponse($request);
                }
            }
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        if ($throttles && !$lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $confirmationCode = str_random(30);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'confirmation_code' => $confirmationCode,
        ]);
        $user->attachRole(2);

        Mail::send('emails.auth.verify', array("confirmation_code" => $confirmationCode), function ($message) {
            $message->to(Input::get('email'), Input::get('name'))
                ->subject('Welcome to ICL Knowledge Base');
        });
        return $user;
    }

    /**
     * Override the function in RegistersUsers.php
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     * @throws \Illuminate\Foundation\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        Auth::guard($this->getGuard())->login($this->create($request->all()));
        
        $output = new \stdClass();
        $output->redirecPath = url($this->redirectPath());
        $output->status = true;
        $output->responseText = "Thank you for your registration. A confirmation email has been sent to your mailbox. Please follow the instruction to activate your account. Enjoy browsing ICL Knowledge Base.";

        if ($request->ajax()) {
            return response()->json($output);
        } else {
            return redirect($this->redirectPath());
        }
    }

    /**
     * Override the function in AuthenticatesUsers.php
     *
     * @param Request $request
     * @param $throttles
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::guard($this->getGuard())->user());
        }

        if ($request->ajax()) {
            $output = new \stdClass();
            $output->redirectPath = url(Session::pull('url.intended', $this->redirectPath()));
            $output->status = true;
            $output->responseText = "You have already logged in.";
            return json_encode($output);
        } else {
            return redirect()->intended($this->redirectPath());
        }
    }

    protected function authenticated(Request $request, $user)
    {
        if ($request->ajax()) {
            $output = new \stdClass();
            $output->redirectPath = url(Session::pull('url.intended', $this->redirectPath()));
            $output->status = true;
            $output->responseText = "You have already logged in.";
            if ($request->wantsJson()) {
                return new JsonResponse($output);
            } else {
                return $output;
            }
        } else {
            return redirect()->intended($this->redirectPath());
        }
    }

    /**
     * Override the function in AuthenticatesUsers.php
     *
     * @param Request $request
     * @return $this
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        if ($request->ajax()) {
            $output = new \stdClass();
            $output->status = false;
            $output->responseJSON = array($this->loginUsername() => $this->getFailedLoginMessage());
            if ($request->wantsJson()) {
                return new JsonResponse($output);
            } else {
                return $output;
            }
        } else {
            return redirect()->back()
                ->withInput($request->only($this->loginUsername(), 'remember'))
                ->withErrors([
                    $this->loginUsername() => $this->getFailedLoginMessage(),
                ]);
        }
    }
}
