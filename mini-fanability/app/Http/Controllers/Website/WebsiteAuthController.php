<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\Entity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class WebsiteAuthController extends Controller
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

        $website = Website::where('email', $request->email)
            ->where('status', 1)
            ->first();

        if ($website && Hash::check($request->password, $website->password)) {

            $request->session()->regenerate();

            Session::put('website_id', $website->id);
            Session::put('website_name', $website->project_name);

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

    // public function dashboard()
    // {
    //     if (!Session::has('website_id')) {
    //         return redirect()->route('website.login');
    //     }

    //     return view('website.dashboard.index');
    // }


    public function dashboard()
{
    if (!Session::has('website_id')) {
        return redirect()->route('website.login');
    }

    $entities = Entity::where('website_id', Session::get('website_id'))
        ->where('status', 1)
        ->orderBy('name')
        ->get();

    return view('website.dashboard.index', compact('entities'));
}
    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Session::forget('website_id');
        Session::forget('website_name');

        $request->session()->regenerateToken();

        return redirect()
            ->route('website.login')
            ->with('success', 'Logged out successfully');
    }
}