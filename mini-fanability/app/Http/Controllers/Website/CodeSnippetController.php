<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\CodeSnippet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CodeSnippetController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | List Code Snippets
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $websiteId = session('website_id');

        $snippets = CodeSnippet::where('website_id', $websiteId)
            ->latest()
            ->get();

        return view('website.code-snippets.index', compact('snippets'));
    }


    /*
    |--------------------------------------------------------------------------
    | Add Code Snippet Form
    |--------------------------------------------------------------------------
    */

    public function add()
    {
        return view('website.code-snippets.add');
    }


    /*
    |--------------------------------------------------------------------------
    | Store Code Snippet
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'code' => 'required',
        ]);

        CodeSnippet::create([
            'website_id' => session('website_id'),
            'name'       => $request->name,
            'slug'       => $request->slug,
            'code'       => $request->code,
        ]);

        return redirect()
            ->route('website.code-snippets')
            ->with('success', 'Code Snippet Created Successfully');
    }

     /*
    |--------------------------------------------------------------------------
    | Duplicate Code Snippet
    |--------------------------------------------------------------------------
    */

    public function duplicate($id)
    {
        $websiteId = session('website_id');
        $snippet = CodeSnippet::where('website_id', $websiteId)
            ->findOrFail($id);

        $slugBase = $snippet->slug !== '' ? $snippet->slug : 'snippet';

        for ($copyNumber = 1; ; $copyNumber++) {
            $suffix = $copyNumber === 1 ? '-copy' : '-copy-' . $copyNumber;
            $slug = rtrim(
                Str::substr($slugBase, 0, 255 - Str::length($suffix)),
                '-'
            ) . $suffix;

            if (!CodeSnippet::where('website_id', $websiteId)->where('slug', $slug)->exists()) {
                break;
            }
        }

        $copy = $snippet->replicate();
        $copy->website_id = $websiteId;
        $copy->name = Str::substr($snippet->name, 0, 250) . ' COPY';
        $copy->slug = $slug;
        $copy->save();

        return redirect()
            ->route('website.code-snippets')
            ->with('success', 'Code snippet duplicated successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | Edit Code Snippet
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $snippet = CodeSnippet::where('website_id', session('website_id'))
            ->findOrFail($id);

        return view('website.code-snippets.edit', compact('snippet'));
    }


    /*
    |--------------------------------------------------------------------------
    | Update Code Snippet
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $snippet = CodeSnippet::where('website_id', session('website_id'))
            ->findOrFail($id);

        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'code' => 'required',
        ]);

        $snippet->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'code' => $request->code,
        ]);

        return redirect()
            ->route('website.code-snippets')
            ->with('success', 'Code Snippet Updated Successfully');
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Code Snippet
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $snippet = CodeSnippet::where('website_id', session('website_id'))
            ->findOrFail($id);

        $snippet->delete();

        return redirect()
            ->route('website.code-snippets')
            ->with('success', 'Code Snippet Deleted Successfully');
    }
}