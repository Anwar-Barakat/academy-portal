<?php

namespace App\Http\Controllers\Setting;

use App\Models\Setting;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Http\Controllers\Controller;
use App\Http\Traits\AttachFileTrait;

class SettingController extends Controller
{
    use AttachFileTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Setting::all();

        $setting = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        return view('pages.settings.index', ['setting' => $setting]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSettingRequest  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingRequest $request)
    {
        if ($request->isMethod('put')) {
            try {
                $data = $request->except(['_method', '_token', 'logo']);

                foreach ($data as $key => $value) {
                    Setting::where('key', $key)->update(['value' => $value]);
                }

                if ($request->hasFile('logo')) {
                    $file_name  = $request->file('logo')->getClientOriginalName();
                    Setting::where('key', 'logo')->update(['value' => $file_name]);
                    $this->deleteFile('logo', $file_name);
                    $this->uploadFile($request, 'logo', 'logo');
                }

                toastr()->success(__('msgs.updated', ['name' => __('trans.settings')]));
                return redirect()->back();
            } catch (\Throwable $th) {
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
