<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Mail\ConfirmRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
protected function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails())
        {
            toastr()->error('sxal');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {
            if (User::where('email', $request->get('email'))->exists()) {
                $user = User::where('email', $request->get('email'))->first();
                $auth = Hash::check($request->get('password'), $user->password);
                if ($auth) {
                    if ($user->status == User::UNBLOCK) {
                        if ($user->hasVerifiedEmail()) {
                            toastr()->success('success');
                            $this->attemptLogin($request);
                        } else {
                            toastr()->warning('krkin mail uxarkel');
                            Mail::to($request->email)->send(new ConfirmRegister($user));
                        }
                    } else {
                        $validator->errors()->add('email', 'admin@ block a are');
                    }
                } else {
                    $validator->errors()->add('password', 'password@ sxal a');
                }
            } else {
                $validator->errors()->add('email', 'Mail chka bazaum');
            }
            toastr()->info('inchvor ban sxal e');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        }
    }

}
