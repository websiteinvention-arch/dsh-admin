<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

class FileManagerController extends Controller
{
    public function index()
    {
        return view('website.file-manager.index');
    }
}