<?php

namespace Services;

use App\Models\Team;
use Services\FileService;
use Hash;

class TeamService
{
    protected $file;

    public function __construct(FileService $file)
    {
        $this->file = $file;
    }

    public function model()
    {
        return New Team;
    }

    public function all()
    {
        return $this->model()->get();
    }

    public function paginate($int = 10)
    {
        return $this->model()->paginate($int);
    }

    public function find($id)
    {
    	return $this->model()->find($id);
    }

    public function auth()
    {
    	return $this->find(auth('team')->id());
    }

    public function create($request)
    {
        return $this->model()->create([
            'avatar'            => $this->file->image($request->file('avatar')),
            'name'              => $request->name,
            'email'             => $request->email,
            'email_verified_at' => now(),
            'password'          => Hash::make($request->password),
        ]);
    }

    public function update($request, $id)
    {
        $data = $this->find($id);

        return $data->update([
            'avatar'   => $this->file->image($request->file('avatar'), $data->avatar),
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->has('password') ? Hash::make($request->password) : $data->password,
        ]);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    public function password($request)
    {
        return $this->auth()->update(['password' => Hash::make($request->new_password)]);
    }
}
