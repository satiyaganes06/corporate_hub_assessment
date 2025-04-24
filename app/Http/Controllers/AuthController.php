<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    // login view
    public function loginShow()
    {
        return view('auth.login');
    }
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return 'view'
     * @author satiyaG <satiyaganes.sg@gmail.com>
     */
    public function login(LoginRequest $request)
    {
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            // Failed login logic
            LogHelper::errorLog('Failed login attempt', ['email' => $request->email]);
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
            
        }

        LogHelper::successLog('Successful login', ['email' => $request->email]);

       
        if(Auth::user()->role == 'admin'){
            return redirect()->route('companies.index')->with('success', 'Login successful');
        }else{
            // Redirect to the user dashboard
            
        }

    }

    /**
     * Logout the user.
     * @return 'view'
     * @author satiyaG <satiyaganes.sg@gmail.com>
     * Logout the user.
     */
    public function logout()
    {   
        $email = Auth::user()->email;
        Auth::logout();
        LogHelper::successLog('User logged out', ['email' => $email]);
        return redirect()->route('auth.login');
    }
}
