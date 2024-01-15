<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChannelRequest;
use Services\Payment\ChannelService;

class ChannelController extends Controller
{
    protected $channel;

    /**
     * Construct
     * @param ChannelService  $channel  Service channel layer
     */
    public function __construct(ChannelService $channel)
    {
        $this->channel = $channel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channels = $this->channel->paginate();

        return view('admin.channels.index', compact('channels'));
    }

    /**
     * Sync the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\ChannelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function sync()
    {
        $this->channel->sync();

        return redirect()->route('admin.channels.index')->with([
            'status' => 'success',
            'message' => 'Data channel berhasil disinkronisasi!'
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
        $channel = $this->channel->find($id);

        return view('admin.channels.show', compact('channel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $channel = $this->channel->find($id);

        return view('admin.channels.edit', compact('channel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\ChannelRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChannelRequest $request, $id)
    {
        $this->channel->update($request, $id);

        return redirect()->route('admin.channels.index')->with([
            'status' => 'success',
            'message' => 'Data channel berhasil diupdate!'
        ]);
    }
}
