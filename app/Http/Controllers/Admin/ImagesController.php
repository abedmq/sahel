<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImagesController extends Controller
{

    private $photos_path;

    public function __construct()
    {
        $this->photos_path = storage_path('app/images');
        $this->cache = storage_path('app/cache');
    }


    /**
     * Display all of the images.
     *
     * @return \Illuminate\Http\Response
     */


    function uploadImageCK(Request $request)
    {
        if ($request->hasFile('file')) {
            $name = $request->file->store('original');
            $file = resize_image($name);
            return response(['status' => true, 'filename' => url(get_images_group($file)['med'] ?? '')]);
        }
    }

    function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $name = $request->file->store('original');
            $file = resize_image($name);
            $data['url'] = $file;
            $data['original_name'] = \request()->file->getClientOriginalName();
            $data['extension'] = \request()->file->getClientOriginalExtension();
            $data['size'] = \request()->file->getSize();
            $data['title'] = '';
            $data['type'] = '';
            $r = \App\Models\File::create($data);
            return response(['status' => true, 'filename' => url(get_images_group($file)['med'] ?? ''), 'id' => $r->id]);
        }
    }

    function remove()
    {
        $file = \App\Models\File::findOrFail(\request('id'));
        remove_image($file->url);
        $file->delete();
        return response(['status' => true]);
    }

}
