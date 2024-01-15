<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeamRequest;
use Services\TeamService;
use App\Models\Designcertificate;

class TeamController extends Controller
{
    protected $team;

    /**
     * Construct
     * @param ChannelService  $team  Service team layer
     */
    public function __construct(TeamService $team)
    {
        $this->team = $team;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = $this->team->paginate();

        return view('admin.teams.index', compact('teams'));
    }

    public function datas(Request $request)
    {
        $data['kode'] = $request->kode;
        $data['horizontal'] = $request->horizontal;
        $data['ishorizontal'] = $request->ishorizontal;
        $data['vertical'] = $request->vertical;
        $data['isvertical'] = $request->isvertical;
        $data['data'] = Designcertificate::findOrFail($data['kode']);
        return view('admin.certificate.templatesertif', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\TeamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamRequest $request)
    {
        $this->team->create($request);

        return redirect()->route('admin.teams.index')->with([
            'status' => 'success',
            'message' => 'Data team berhasil ditambahkan!'
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
        $team = $this->team->find($id);

        return view('admin.teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = $this->team->find($id);

        return view('admin.teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\TeamRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeamRequest $request, $id)
    {
        $this->team->update($request, $id);

        return redirect()->route('admin.teams.index')->with([
            'status' => 'success',
            'message' => 'Data team berhasil diupdate!'
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
        $this->team->delete($id);

        return back()->with([
            'status' => 'success',
            'message' => 'Data team berhasil dihapus!'
        ]);
    }
}
