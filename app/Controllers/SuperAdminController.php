<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SuperAdminModel;
use App\Models\SiteSystemModel;

class SuperAdminController extends BaseController
{
    /* ================= LOGIN PAGE ================= */
    public function login()
    {
        return view('superadmin/login');
    }

    /* ================= LOGIN POST ================= */
    public function loginPost()
{
    $model = new SuperAdminModel();

    $email = trim($this->request->getPost('email'));
    $password = trim($this->request->getPost('password'));

    $admin = $model
        ->where('email', $email)
        ->where('password', $password) // 👈 direct compare
        ->first();

    if (!$admin) {
        return redirect()->back()->with('msg', 'Invalid email or password');
    }

    session()->set([
        'superadmin' => true,
        'admin_id'   => $admin['id']
    ]);

    return redirect()->to('/superadmin/settings');
}

    /* ================= SETTINGS PAGE ================= */
    public function settings()
    {
        if (!session('superadmin')) {
            return redirect()->to('/superadmin/login');
        }

        $model = new SiteSystemModel();
        $system = $model->find(1);

        return view('superadmin/settings', [
            'system' => $system
        ]);
    }

    /* ================= SAVE SETTINGS ================= */
    public function saveSettings()
    {
        if (!session('superadmin')) {
            return redirect()->to('/superadmin');
        }

        $model = new SiteSystemModel();

        $data = [
            'site_name' => $this->request->getPost('site_name')
        ];

        // Logo upload
        $file = $this->request->getFile('logo');
        if ($file && $file->isValid()) {
            $name = $file->getRandomName();
            $file->move('uploads', $name);
            $data['logo'] = $name;
        }

        $model->update(1, $data);

        return redirect()->back()->with('success', 'System updated successfully');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/superadmin');
    }
}
