<?php

namespace App\Controllers;

use App\Models\DownloadModel; // 

class Download extends BaseController
{
    public function index()
    {
        $model = new DownloadModel();
        $users = $model->getUserData();

        echo '<pre>';
        print_r($users);
    }
}
