<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AccountRequest;
use App\Http\Requests\User\PasswordRequest;
use Services\UserService;

class AccountController extends Controller
{
    protected $user;

    public function __construct(UserService $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $user = $this->user->auth();

        return view('user.account.profile', compact('user'));
    }

    public function update(AccountRequest $request)
    {
        $this->user->patch($request);

        return back()->with([
            'status' => 'success',
            'message' => 'Data berhasil diupdate!'
        ]);
    }

    public function password()
    {
        return view('user.account.password');
    }

    public function updatePassword(PasswordRequest $request)
    {
        $this->user->password($request);

        return back()->with([
            'status' => 'success',
            'message' => 'Password berhasil diubah!'
        ]);
    }
}
