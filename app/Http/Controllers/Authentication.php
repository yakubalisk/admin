<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Auth;

class Authentication extends Controller
{

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            // return $request;
            $credentials = $request->only('email', 'password');
            // return $credentials;
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if ($user->user_type == 'admin') {
                    return redirect('/dashboard');
                } else {
                    return redirect()->route('customer.dashboard');
                }
            }else{
                return 'Password not match';
            }
        }else{
            return view('master.login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
