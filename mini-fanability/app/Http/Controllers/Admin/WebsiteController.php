<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website;
use Illuminate\Support\Facades\Hash;

class WebsiteController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Website Listing
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $websites = Website::latest()->get();

        return view('admin.websites.index', compact('websites'));
    }

    /*
    |--------------------------------------------------------------------------
    | Add Website Form
    |--------------------------------------------------------------------------
    */

    public function add()
    {
        return view('admin.websites.add');
    }

    /*
    |--------------------------------------------------------------------------
    | Store Website
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required',
            'project_name' => 'required',
            'email' => 'required|email|unique:websites,email',
            'password' => 'required|min:6',
        ]);

        Website::create([
            'client_name' => $request->client_name,
            'project_name' => $request->project_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'description' => $request->description,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->back()
            ->with('success', 'Website Created Successfully');
    }

    /*
|--------------------------------------------------------------------------
| Edit Website Form
|--------------------------------------------------------------------------
*/

public function edit($id)
{
    $website = Website::findOrFail($id);

    return view('admin.websites.edit', compact('website'));
}

/*
|--------------------------------------------------------------------------
| Update Website
|--------------------------------------------------------------------------
*/

public function update(Request $request, $id)
{
    $website = Website::findOrFail($id);

    $request->validate([
        'client_name' => 'required',
        'project_name' => 'required',
        'email' => 'required|email|unique:websites,email,' . $website->id,
    ]);

    $data = [
        'client_name' => $request->client_name,
        'project_name' => $request->project_name,
        'email' => $request->email,
        'phone' => $request->phone,
        'description' => $request->description,
        'status' => $request->status,
    ];

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $website->update($data);

    return redirect()->route('admin.websites')
        ->with('success', 'Website Updated Successfully');
    }

    public function destroy($id)
    {
        $website = Website::findOrFail($id);
        $website->delete();

        return redirect()->back()
            ->with('success', 'Website Deleted Successfully');
    }
}