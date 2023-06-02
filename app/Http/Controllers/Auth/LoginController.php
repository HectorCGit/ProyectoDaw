<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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

    private string $redirectTo;

    /**
     * Redirección tras login
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    public function redirectTo(): string
    {
        if(Auth::user()->email_verified_at){
            if(Auth::user()->hasAnyRole('company')){
                return $this->redirectTo = route('homeCompany') ;

            }else{
                return $this->redirectTo = route('homePassenger') ;
            }
        }else{
            return $this->redirectTo = route('verify') ;
        }
    }
    /**
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
