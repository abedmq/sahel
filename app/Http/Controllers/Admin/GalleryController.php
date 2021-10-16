<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateUpdateGalleryRequest as CreateUpdateRequest;
use App\Models\Album;
use App\Models\File;
use Illuminate\Http\Request;

class GalleryController extends BaseController
{

    protected $modelClass = Album::class;
    protected $title = 'معرض الصور';
    protected $route = 'galleries';

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    function index()
    {
        $query = $this->model->type('galleries')->withCount('files');
        return $this->all($query);
    }

    function show(Album $gallery)
    {
        return redirect()->back()->with('msg', 'لا يوجد تفاصيل');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUpdateRequest $request)
    {
        //
        return $this->saveData($request->validated());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Album $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUpdateRequest $request, Album $gallery)
    {
        //
        return $this->saveData($request->validated(), $gallery);
    }

    public function saveData($data, $item = null)
    {
        $data['type'] = 'galleries';
        if (!isset($data['without_album'])) {
            if ($item) {
                $item->update($data);
            } else
                $item = Album::create($data);
        }

        File::whereIn('id', $data['images'])->update(['album_id' => $item->id ?? 0, 'title' => $data['title'] ?? '', 'type' => 'galleries']);

        return $this->response()->route($this->prefix . $this->route . '.index')->success('تم الحفظ بنجاح')->with('clear', $item ? 'no' : 'yes');
    }
}
