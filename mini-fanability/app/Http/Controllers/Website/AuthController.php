<?php

namespace App\Http\Controllers\Website;

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
        return view('website.auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | Login Submit
    |--------------------------------------------------------------------------
    */

    public function loginSubmit(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = [
        'email' => $request->email,
        'password' => $request->password,
        'status' => 1,
    ];

    if (Auth::guard('website')->attempt($credentials)) {

        $request->session()->regenerate();

        return redirect()
            ->route('website.dashboard')
            ->with('success', 'Login Successful');
    }

    return redirect()
        ->back()
        ->with('error', 'Invalid Credentials');
}

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    public function dashboard()
{
    return view('website.dashboard');
}

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
{
    Auth::guard('website')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()
        ->route('website.login')
        ->with('success', 'Logged out successfully');
}
}