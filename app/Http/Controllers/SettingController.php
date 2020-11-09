<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\Traits\DeleteItemModelTrait;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    use DeleteItemModelTrait;
    private $setting;

    function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    function index()
    {
        $settings = $this->setting->latest()->simplePaginate(5);
        return view('admin.setting.index', compact('settings'));
    }

    function create()
    {
        return view('admin.setting.create');
    }

    function createSubmit(SettingRequest $request)
    {
        $data = [
            'config_key' => $request->config_key,
            'config_value' => $request->config_value,
        ];
        $this->setting->create($data);
        return redirect()->route('settings.index');
    }

    function edit($id)
    {
        $setting = $this->setting->find($id);
        return view('admin.setting.edit', compact('setting'));
    }

    function update(SettingRequest $request, $id)
    {
        $data = [
            'config_key' => $request->config_key,
            'config_value' => $request->config_value,
        ];
        $this->setting->find($id)->update($data);
        return redirect()->route('settings.index');
    }

    function delete($id)
    {
        return $this->deleteItemTrait($id, $this->setting);
    }
}
