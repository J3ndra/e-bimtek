<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Services\FileService;
use Services\SettingService;

class SettingController extends Controller
{
    protected $setting;

    /**
     * Construct
     * @param SettingService  $setting  Service setting layer
     */
    public function __construct(SettingService $setting, FileService $file)
    {
        $this->setting = $setting;
        $this->file = $file;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = $this->setting->all();

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->slug != 'f_link') {
            return redirect()->route('admin.settings.index')->with([
                'status' => 'danger',
                'message' => 'Data pengaturan tidak dapat ditambahkan!'
            ]);
        }

        Setting::create([
            'slug' => $request->slug,
            'title' => $request->title,
            'value' => $request->value,
        ]);

        return redirect()->route('admin.settings.index')->with([
            'status' => 'success',
            'message' => 'Data pengaturan berhasil ditambahkan!'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting = $this->setting->findOrFail($id);

        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\SettingRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, $id)
    {
        $setting = $this->setting->find($id);
        if ($setting->type == 'file') {
            $request->value = $this->file->image($request->file('value'));
        }
        // dd($request->all());

        $this->setting->update($request, $id);

        return redirect()->route('admin.settings.index')->with([
            'status' => 'success',
            'message' => 'Data setting berhasil diupdate!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);
        if ($setting->can_delete == false) {
            return redirect()->route('admin.settings.index')->with([
                'status' => 'danger',
                'message' => 'Data pengaturan tidak dapat dihapus!'
            ]);
        }

        $setting->delete();

        return redirect()->route('admin.settings.index')->with([
            'status' => 'success',
            'message' => 'Data setting berhasil dihapus!'
        ]);
    }
}
