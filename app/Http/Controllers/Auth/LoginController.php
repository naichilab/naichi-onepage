<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

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
    * Redirect the user to the GitHub authentication page.
    *
    * @return Response
    */
    public function redirectToProvider()
    {
      logger('redirectToProvider');
      return Socialite::driver('twitter')->redirect();
    }

    /**
    * Obtain the user information from GitHub.
    *
    * @return Response
    */
    public function handleProviderCallback()
    {
      logger('handleProviderCallback');
      $user = Socialite::driver('twitter')->user();

      // All Providers
      logger($user->getId());
      logger($user->getNickname());
      logger($user->getName());
      logger($user->getEmail());
      logger($user->getAvatar());

      echo '<pre>' . var_export($user, true) . '</pre>';
      // $user->token;
      return 'OK';
    }
}
