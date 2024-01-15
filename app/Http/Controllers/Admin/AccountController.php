<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AccountRequest;
use App\Http\Requests\Admin\PasswordRequest;
use Services\AdminService;

class AccountController extends Controller
{
    protected $admin;

    public function __construct(AdminService $admin)
    {
        $this->admin = $admin;
    }

    public function index()
    {
        $admin = $this->admin->auth();

        return view('admin.account.profile', compact('admin'));
    }

    public function update(AccountRequest $request)
    {
        $this->admin->update($request, auth('admin')->id());

        return back()->with([
            'status' => 'success',
            'message' => 'Data berhasil diupdate!'
            ]);
        }

        public function password()
        {
            return view('admin.account.password');
        }

        public function updatePassword(PasswordRequest $request)
        {
            $this->admin->password($request);

            return back()->with([
                'status' => 'success',
                'message' => 'Password berhasil diubah!'
                ]);
            }
        }
