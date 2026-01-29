<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseAdminController;
use App\Models\SettingModel;

class Settings extends BaseAdminController
{
    protected $settingModel;

    public function __construct()
    {
        parent::__construct();
        $this->settingModel = new SettingModel();
    }

    /**
     * Show all settings
     */
    public function index()
    {
        $settings = $this->settingModel->allSettings();
        return view('admin/settings/index', ['settings' => $settings]);
    }

    /**
     * Save or update setting
     */
    public function save()
    {
        $key   = $this->request->getPost('key');
        $value = $this->request->getPost('value');
        $date  = $this->request->getPost('date') ?: null;

        // For full_day_closed, treat empty value as "1"
        if ($key === 'full_day_closed') {
            $value = '1';
        }

        if (!$key) {
            return redirect()->back()->with('error', 'Key is required.');
        }

        // Save or update
        $this->settingModel->setValue($key, $value, $date);

        return redirect()->back()->with('success', 'Setting saved successfully.');
    }
}
