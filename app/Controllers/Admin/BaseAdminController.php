<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class BaseAdminController extends BaseController
{
    public function __construct()
    {
        helper('url'); // to use redirect()

        // Check if admin session exists
        $admin = session()->get('admin');
        if (!$admin || !$admin['logged']) {
            // Not logged in → redirect to login
            redirect()->to('/admin/login')->send();
            exit; // stop further execution
        }
    }
}
