<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm ()
    {
        return view('front.pages.Login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Session::put('user', $data['name']);
            return redirect()->route('admin')->with('success', 'You Logged In Successfully!');
        }
        else {
            return redirect()->back()->with('error','The User Or Password Is Incorrect');
        }
    }
}
