<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\AccountRequest;
use App\Http\Requests\Team\PasswordRequest;
use Services\TeamService;

class AccountController extends Controller
{
    protected $team;

    public function __construct(TeamService $team)
    {
        $this->team = $team;
    }

    public function index()
    {
        $team = $this->team->auth();

        return view('team.account.profile', compact('team'));
    }

    public function update(AccountRequest $request)
    {
        $this->team->update($request, auth('team')->id());

        return back()->with([
            'status' => 'success',
            'message' => 'Data berhasil diupdate!'
        ]);
    }

    public function password()
    {
        $team = $this->team->auth();

        return view('team.account.password', compact('team'));
    }

    public function updatePassword(PasswordRequest $request)
    {
        $this->team->password($request);

        return back()->with([
            'status' => 'success',
            'message' => 'Password berhasil diubah!'
        ]);
    }
}
