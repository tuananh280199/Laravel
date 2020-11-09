<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Traits\DeleteItemModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    use StorageImageTrait;
    use DeleteItemModelTrait;
    private $slider;

    function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    function index()
    {
        $sliders = $this->slider->latest()->simplePaginate(5);
        return view('admin.slider.index', compact('sliders'));
    }

    function create()
    {
        return view('admin.slider.create');
    }

    function createSubmit(SliderRequest $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'description' => $request->description,

            ];
            $dataUploadImage = $this->storageTraitUploadFile($request, 'image_path', 'slider');
            if (!empty($dataUploadImage)) {
                $data['image_path'] = $dataUploadImage['file_path'];
            }
            $this->slider->create($data);
            return redirect()->route('sliders.index');
        } catch (\Exception $err) {
            Log::error('Error: ' . $err->getMessage() . 'Line: ' . $err->getLine());
        }
    }

    function edit($id)
    {
        $slider = $this->slider->find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    function update(SliderRequest $request, $id)
    {
        try {
            $data = [
                'name' => $request->name,
                'description' => $request->description,

            ];
            $dataUploadImage = $this->storageTraitUploadFile($request, 'image_path', 'slider');
            if (!empty($dataUploadImage)) {
                $data['image_path'] = $dataUploadImage['file_path'];
            }
            $this->slider->find($id)->update($data);
            return redirect()->route('sliders.index');
        } catch (\Exception $err) {
            Log::error('Error: ' . $err->getMessage() . 'Line: ' . $err->getLine());
        }
    }

    function delete($id)
    {
        return $this->deleteItemTrait($id, $this->slider);
    }
}
