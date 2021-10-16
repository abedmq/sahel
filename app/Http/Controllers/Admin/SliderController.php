<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\CreateUpdateSliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends BaseController
{

    protected $modelClass = Slider::class;
    protected $title = 'الصور';
    protected $route = 'sliders';
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    function show(Slider $slider)
    {
        return redirect()->back()->with('msg','لا يوجد تفاصيل');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUpdateSliderRequest $request)
    {
        //
        return $this->saveData($request->validated());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUpdateSliderRequest $request, Slider $slider)
    {
        //
        return $this->saveData($request->validated(),  $slider);
    }

    public function saveData($data, $item = null)
    {
        unset($data['image']);
        if (\request()->image) {
            $name = \request()->image->store("original");
            $imgName = resize_image($name);
            if ($imgName)
                $data['image'] = $imgName;
        }
        return parent::saveData($data, $item); // TODO: Change the autogenerated stub
    }
}