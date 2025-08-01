<?php

namespace App\Http\Controllers\backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\Providers\RouteServiceProvider;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    // protected $redirectTo = '/home';

    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    //     $this->middleware('auth')->only('logout');
    // }

    
    public function showLoginForm()
    {
        return view('backend/auth/admin_login');
     
    }


public function admin_login(Request $request)
{
    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);
    

    if(Auth::guard('admin')->attempt(['email' => $request->email,'password' => $request->password], $request->filled('remember')))
    {
        session()->flash('success', 'Successfully Logged in!');
        return redirect()->intended(route('admin.dashboard'));
    } else {
        return 0;

        if(Auth::guard('admin')->attempt(['username' => $request->email, 'password' => $request->password], $request->filled('remember')))
        {
            session()->flash('success', 'Successfully Logged in!');
            return redirect()->intended(route('admin.dashboard'));
        }
            session()->flash('error', 'Invalid email or password');
            return back();
    }
}


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
