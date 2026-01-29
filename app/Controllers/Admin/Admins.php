<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Admins extends BaseController
{
    public function index()
    {
        $model = new AdminModel();

        return view('admin/admins/index', [
            'admins' => $model->findAll()
        ]);
    }

    public function create()
    {
        return view('admin/admins/create');
    }

    public function store()
    {
        $model = new AdminModel();

        $model->insert([
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            )
        ]);

        return redirect()->to('/admin/admins')->with('success', 'Admin added successfully');
    }

    public function toggleStatus($id)
{
    $model = new AdminModel();

    $admin = $model->find($id);
    if (!$admin) {
        return redirect()->back()->with('error', 'Admin not found');
    }

    // Toggle: 1 → 0 OR 0 → 1
    $model->update($id, [
        'status' => $admin['status'] ? 0 : 1
    ]);

    return redirect()->back()->with('success', 'Admin status updated');
}

}
