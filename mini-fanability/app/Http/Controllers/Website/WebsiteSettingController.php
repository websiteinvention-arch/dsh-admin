<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
use App\Services\WebsiteSeoFiles;

class WebsiteSettingController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Settings Page
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $websiteId = session('website_id');

        $settings = WebsiteSetting::where('website_id', $websiteId)
            ->first();

        return view('website.settings.index', compact('settings'));
    }


    /*
    |--------------------------------------------------------------------------
    | Store / Update Settings
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, WebsiteSeoFiles $seoFiles)
    {
        $websiteId = session('website_id');

        $request->validate([
            'logo' => 'nullable|image',
            'white_logo' => 'nullable|image',
            'favicon' => 'nullable|image',

            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',

            'domain' => 'nullable',
            'destination_url' => 'nullable|url',

            'youtube' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
        ]);


        $settings = WebsiteSetting::where('website_id', $websiteId)
            ->first();


        /*
        |--------------------------------------------------------------------------
        | Upload Logo
        |--------------------------------------------------------------------------
        */

        $logo = $settings->logo ?? null;

        if ($request->hasFile('logo')) {

            $logo = $request->file('logo')
                ->store('website-settings', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Upload White Logo
        |--------------------------------------------------------------------------
        */

        $whiteLogo = $settings->white_logo ?? null;

        if ($request->hasFile('white_logo')) {

            $whiteLogo = $request->file('white_logo')
                ->store('website-settings', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Upload Favicon
        |--------------------------------------------------------------------------
        */

        $favicon = $settings->favicon ?? null;

        if ($request->hasFile('favicon')) {

            $favicon = $request->file('favicon')
                ->store('website-settings', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Save Settings
        |--------------------------------------------------------------------------
        */

        WebsiteSetting::updateOrCreate(

            [
                'website_id' => $websiteId,
            ],

            [
                'logo' => $logo,
                'white_logo' => $whiteLogo,
                'favicon' => $favicon,

                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,

                'domain' => $request->domain,
                'destination_url' => $request->destination_url,

                'youtube' => $request->youtube,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
            ]
        );

        $seoFiles->regenerate((int) $websiteId);

        return redirect()
            ->route('website.settings')
            ->with('success', 'Website Settings Updated Successfully');
    }
}