<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('admin/auth/login');
    }

    public function attemptLogin()
    {
        $model = new AdminModel();

        $admin = $model
            ->where('email', $this->request->getPost('email'))
            ->where('status', 1)
            ->first();

        if (!$admin || !password_verify($this->request->getPost('password'), $admin['password'])) {
            return redirect()->back()->with('error', 'Invalid email or password');
        }

        session()->set('admin', [
            'id'     => $admin['id'],
            'name'   => $admin['name'],
            'logged' => true
        ]);

        return redirect()->to('/admin/dashboard');
    }

public function logout()
{
    session()->destroy();  // destroy admin session
    return redirect()->to('/admin/login'); // ✅ correct path
}


}
