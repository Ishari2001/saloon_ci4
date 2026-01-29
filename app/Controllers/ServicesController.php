<?php
namespace App\Controllers;

use App\Models\ServiceModel;
use App\Models\SiteSystemModel;

class ServicesController extends BaseController
{
    protected $service;
    protected $siteSystemModel;

    public function __construct()
    {
        $this->service = new ServiceModel();
        $this->siteSystemModel = new SiteSystemModel();
    }

    // Display all active services
    public function index()
    {
        $data['services'] = $this->service
            ->where('status', 'active')
            ->orderBy('id', 'DESC')
            ->findAll();

        // Fetch system/site settings
        $data['system'] = $this->siteSystemModel->first();

        return view('services/index', $data);
    }
}
