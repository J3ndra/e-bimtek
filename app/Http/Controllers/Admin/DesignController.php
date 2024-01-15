<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\DesignRequest;
use Services\Course\DesignService;
use App\Models\Design;
use PDF;

class DesignController extends Controller
{
    protected $design;

    public function __construct(DesignService $design)
    {
        $this->design = $design;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->design->paginate();

        return view('admin.designs.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.designs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\DesignRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DesignRequest $request)
    {
        $this->design->create($request);

        return redirect()->route('admin.designs.index')->with([
            'status' => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $design = $this->design->find($id);

        return view('admin.designs.show', compact('design'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $design = $this->design->find($id);

        return view('admin.designs.edit', compact('design'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\DesignRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DesignRequest $request, $id)
    {
        $this->design->update($request);

        return redirect()->route('admin.designs.index')->with([
            'status' => 'success',
            'message' => 'Data berhasil diupdate'
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
        if ($this->design->delete($id)) {
            return back()->with([
                'status' => 'success',
                'message' => 'Data desain sertifikat berhasil dihapus'
            ]);
        } else {
            return back()->with([
                'status' => 'danger',
                'message' => 'Ada kursus yang menggunakan desain ini, operasi dibatalkan'
            ]);
        }
    }

    public function updatem(Request $request, $id)
    {
        $kode = $request->kode;

        $design = Design::find($kode);
        $design->n_import_font = $request->n_import_font;
        $design->n_horizontal = $request->n_horizontal;
        $design->n_margin_right = $request->n_margin_right;
        $design->n_vertical = $request->n_vertical;
        $design->n_margin_left = $request->n_margin_left;
        $design->n_font_style = $request->n_font_style;
        $design->n_font_size = $request->n_font_size;

        $design->d_import_font = $request->d_import_font;
        $design->d_horizontal = $request->d_horizontal;
        $design->d_width = $request->d_width;
        $design->d_margin_right = $request->d_margin_right;
        $design->d_vertical = $request->d_vertical;
        $design->d_margin_left = $request->d_margin_left;
        $design->d_font_style = $request->d_font_style;
        $design->d_font_size = $request->d_font_size;

        $design->save();
        $data['data'] = $design;

        $html = view('admin.designs.templatesertif', $data);
        $pdf = PDF::loadHTML($html);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('Preview - Certificate.pdf');
    }

    public function updatefont(Request $request, $id)
    {
        $up = Design::findOrFail($id);

        if (empty($request->value)) {
            $up->d_import_font = $request->d_value;
        } else {
            $up->n_import_font = $request->value;
        }

        $up->update();
    }

    public function datas(Request $request)
    {
        // dd($request->all());
        $kode = $request->kode;

        $design = Design::find($kode);
        $design->n_import_font = $request->n_import_font;
        $design->n_horizontal = $request->n_horizontal;
        $design->n_margin_right = $request->n_margin_right;
        $design->n_vertical = $request->n_vertical;
        $design->n_margin_left = $request->n_margin_left;
        $design->n_font_style = $request->n_font_style;
        $design->n_font_size = $request->n_font_size;

        $design->d_import_font = $request->d_import_font;
        $design->d_horizontal = $request->d_horizontal;
        $design->d_margin_right = $request->d_margin_right;
        $design->d_vertical = $request->d_vertical;
        $design->d_margin_left = $request->d_margin_left;
        $design->d_font_style = $request->d_font_style;
        $design->d_font_size = $request->d_font_size;

        $design->save();
        $data['data'] = $design;
        return view('admin.designs.templatesertif', $data);
    }
}
