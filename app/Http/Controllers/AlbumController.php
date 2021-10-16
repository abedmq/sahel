<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Letter;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    //
    function show($id)
    {
        $album = Album::findOrFail($id);
        $title='مرفقات جاهزة للتحميل';
        return view('front.albums.show', compact('album','title'));
    }
}
