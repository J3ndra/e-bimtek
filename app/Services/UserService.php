<?php

namespace Services;

use App\Models\User;
use Services\FileService;
use Hash;

class UserService
{
    protected $file;

    public function __construct(FileService $file)
    {
        $this->file = $file;
    }

    public function model()
    {
        return User::with('certificates');
    }

    public function all()
    {
        return $this->model()->get();
    }

    public function verified($int = 10)
    {
        return $this->model()->paginate($int);
    }

    public function find($id)
    {
        return $this->model()->find($id);
    }

    public function auth()
    {
        return $this->find(auth('web')->id());
    }

    public function create($request)
    {
        return $this->model()->create([
            'avatar'            => $this->file->image($request->file('avatar')),
            'name'              => $request->name,
            'email'             => $request->email,
            'email_verified_at' => now(),
            'password'          => Hash::make($request->password),
            'telp'              => $request->telp,
        ]);
    }

    public function update($request, $id)
    {
        $user = $this->find($id);

        return $user->update([
            'avatar'   => $this->file->image($request->file('avatar'), $user->avatar),
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->has('password') ? Hash::make($request->password) : $user->password,
            'telp'     => $request->telp,
        ]);
    }

    public function patch($request)
    {
        $user = $this->find(auth('web')->id());
        $patch = [
            'avatar'   => $this->file->image($request->file('avatar'), $user->avatar),
            'name'     => $request->name,
            'email'    => $request->email,
            'telp'     => $request->telp,
        ];

        if ($user->email != $request->email) {
            $patch['email_verified_at'] = NULL;
        }

        return $user->update($patch);
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
