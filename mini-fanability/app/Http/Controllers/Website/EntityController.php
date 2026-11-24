<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entity;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class EntityController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | List Entities
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $websiteId = Session::get('website_id');

        $entities = Entity::where('website_id', $websiteId)
            ->latest()
            ->get();

        return view('website.entities.index', compact('entities'));
    }

    /*
    |--------------------------------------------------------------------------
    | Add Form
    |--------------------------------------------------------------------------
    */

    public function add()
    {
        return view('website.entities.add');
    }

    /*
    |--------------------------------------------------------------------------
    | Store Entity (Create Module)
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:entities,name',
        ]);

        $websiteId = Session::get('website_id');

        Entity::create([
            'website_id' => $websiteId,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('website.entities')
            ->with('success', 'Module Created Successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $websiteId = Session::get('website_id');

        $entity = Entity::where('website_id', $websiteId)
            ->where('id', $id)
            ->firstOrFail();

        return view('website.entities.edit', compact('entity'));
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $websiteId = Session::get('website_id');

        $entity = Entity::where('website_id', $websiteId)
            ->where('id', $id)
            ->firstOrFail();

        $entity->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('website.entities')
            ->with('success', 'Module Updated Successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $websiteId = Session::get('website_id');

        $entity = Entity::where('website_id', $websiteId)
            ->where('id', $id)
            ->firstOrFail();
        $entity->delete();

        return redirect()->back()
            ->with('success', 'Module Deleted Successfully');
    }
}