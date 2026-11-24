<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Page
    |--------------------------------------------------------------------------
    */
    public function login()
    {
        return view('admin.login');
    }

    /*
    |--------------------------------------------------------------------------
    | Login Submit
    |--------------------------------------------------------------------------
    */
   public function loginSubmit(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    $credentials = [
        'email'    => $request->email,
        'password' => $request->password,
    ];

    if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'super_admin') {

            return redirect()->route('admin.dashboard')
                ->with('success', 'Login Successful');
        }

        return redirect()->route('website.login')
            ->with('success', 'Login Successful');
    }

    return redirect()->back()
        ->with('error', 'Invalid Email or Password');
}

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Logout Successful');
    }
}