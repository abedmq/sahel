<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\File;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    //
    function index()
    {
        $albums = Album::type('galleries')->with('files')->paginate(25);
        $title = "معرض الصور";
        return view('front.letters.create', compact('albums', 'title'));
    } //
}
