<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\File;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    //
    function index($id = 0)
    {
        $galleries = Album::type('galleries')->sort()->with('files')->get();
        $gallery=null;
        if ($id)
            $gallery = Album::type('galleries')->find($id);

        $title = "معرض الصور";
        return view('front.galleries.show', compact('galleries','gallery', 'title'));
    } //
}
