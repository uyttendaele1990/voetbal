<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Model\user\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
         * Redirect the user 
         *
         * @return \Illuminate\Http\Response
         */
        public function redirectToProvider()
        {
            return Socialite::driver('google')->stateless()->redirect();
        }

        /**
         * Obtain the user information
         *
         * @return \Illuminate\Http\Response
         */
        public function handleProviderCallback()
        {
            //de usergegevens van wie inlogd met de google login knop
            $loginUser = Socialite::driver('google')->stateless()->user();

            $findUser = User::where('email', $loginUser->email)->first();

            if($findUser){
                Auth::login($findUser);
                return redirect(route('home'));
            } else {
                $user = new User;
                $user->name = $loginUser->name;
                $user->email = $loginUser->email;
                $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
                $user->password = $randomString;
                $user->google = 1;
                Mail::to($user['email'])->send(new WelcomeEmail($user));
                $user->password = bcrypt($randomString);
                $user->save();
                Auth::login($user);
                
                return redirect(route('home'));
            }
        }
}
