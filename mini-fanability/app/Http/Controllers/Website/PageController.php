<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Page;

class PageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | List Pages
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $websiteId = session('website_id');

        $pages = Page::where('website_id', $websiteId)
            ->latest()
            ->get();

        return view('website.pages.index', compact('pages'));
    }


    /*
    |--------------------------------------------------------------------------
    | Add Page
    |--------------------------------------------------------------------------
    */

    public function add()
    {
        return view('website.pages.add');
    }


    /*
    |--------------------------------------------------------------------------
    | Store Page
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'page_name' => 'required',
            'slug' => 'required',
            'page_content' => 'nullable',
            'browser_title' => 'nullable',
            'meta_keywords' => 'nullable',
            'page_keyword' => 'nullable',
            'meta_description' => 'nullable',
            'page_image' => 'nullable',
            'text_variable' => 'nullable',
            'include_in_head' => 'nullable',
            'include_in_footer' => 'nullable',
            'template_file' => 'nullable',
            'status' => 'nullable',
        ]);

    
        Page::create([
            'website_id' => session('website_id'),
            'page_name' => $request->page_name,
            'slug' => $request->slug,
            'page_content' => $request->page_content,
            'browser_title' => $request->browser_title,
            'meta_keywords' => $request->meta_keywords,
            'page_keyword' => $request->page_keyword,
            'meta_description' => $request->meta_description,
            'page_image' => $request->page_image,
            'text_variable' => $request->text_variable,
            'include_in_head' => $request->include_in_head,
            'include_in_footer' => $request->include_in_footer,
            'template_file' => $request->template_file,
            'status' => $request->status ?? 1,
        ]);

        return redirect()
            ->route('website.pages')
            ->with('success', 'Page Created Successfully');
    }


    /*
    |--------------------------------------------------------------------------
    | Edit Page
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $page = Page::where('website_id', session('website_id'))
            ->findOrFail($id);

        return view('website.pages.edit', compact('page'));
    }


     /*
    |--------------------------------------------------------------------------
    | Duplicate Page
    |--------------------------------------------------------------------------
    */

    public function duplicate($id)
    {
        $websiteId = session('website_id');
        $page = Page::where('website_id', $websiteId)
            ->findOrFail($id);

        $slugBase = $page->slug !== '' ? $page->slug : 'page';

        for ($copyNumber = 1; ; $copyNumber++) {
            $suffix = $copyNumber === 1 ? '-copy' : '-copy-' . $copyNumber;
            $slug = rtrim(
                Str::substr($slugBase, 0, 255 - Str::length($suffix)),
                '-'
            ) . $suffix;

            if (!Page::where('website_id', $websiteId)->where('slug', $slug)->exists()) {
                break;
            }
        }

        $copy = $page->replicate();
        $copy->website_id = $websiteId;
        $copy->page_name = Str::substr($page->page_name, 0, 247) .' COPY'  ;
        $copy->slug = $slug;
        $copy->status = 0;
        $copy->save();

        return redirect()
            ->route('website.pages')
            ->with('success', 'Page duplicated successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | Update Page
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $page = Page::where('website_id', session('website_id'))
            ->findOrFail($id);

        $request->validate([
            'page_name' => 'required',
            'slug' => 'required',
            'page_content' => 'nullable',
            'browser_title' => 'nullable',
            'meta_keywords' => 'nullable',
            'page_keyword' => 'nullable',
            'meta_description' => 'nullable',
            'page_image' => 'nullable',
            'text_variable' => 'nullable',
            'include_in_head' => 'nullable',
            'include_in_footer' => 'nullable',
            'template_file' => 'nullable',
            'status' => 'nullable',
        ]);

       

        $page->update([
            'page_name' => $request->page_name,
            'slug' => $request->slug,
            'page_content' => $request->page_content,
            'browser_title' => $request->browser_title,
            'meta_keywords' => $request->meta_keywords,
            'page_keyword' => $request->page_keyword,
            'meta_description' => $request->meta_description,
            'page_image' => $request->page_image,
            'text_variable' => $request->text_variable,
            'include_in_head' => $request->include_in_head,
            'include_in_footer' => $request->include_in_footer,
            'template_file' => $request->template_file,
            'status' => $request->status ?? 1,
        ]);

        return redirect()
            ->route('website.pages')
            ->with('success', 'Page Updated Successfully');
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Page
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $page = Page::where('website_id', session('website_id'))
            ->findOrFail($id);

        $page->delete();

        return redirect()
            ->route('website.pages')
            ->with('success', 'Page Deleted Successfully');
    }
}