<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Session\Session;

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

    use AuthenticatesUsers {
        logout as performLogout;
    }

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

    public function logout(Request $request)
    {
        $isAdmin = auth()->user()->hasRole('admin');
        $loginRoute = $isAdmin ? 'admin.login' : 'login';

        $this->performLogout($request);
        
        return redirect()->route($loginRoute);
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            if(Auth::user()->status == User::ACTIVE) {
                if(Auth::user()->hasRole('admin')) {
                    return redirect()->route('admin.dashboard.index')->with('success', 'Welcome '.Auth::user()->name);
                }else {
                    return redirect()->route('client.index');
                }
            } else {
                $isAdmin = auth()->user()->hasRole('admin');
                $loginRoute = $isAdmin ? 'admin.login' : 'login';
                Auth::logout();
                
                return redirect()->route($loginRoute)->withErrors(
                    [
                        'Sorry your account has been banned!'
                    ]
                );
            }
        }else{
            return redirect()->back()->withErrors(
                [
                    'Invalid Username and Password!'
                ]
            );
        }
    }

    public function showLoginClientForm()
    {
        return view('client.pages.login.index');
    }

    public function redirectTo()
    {
        if (auth()->user()->role == 'admin') {
            return '/admin';
        }

        return '/';
    }
}
