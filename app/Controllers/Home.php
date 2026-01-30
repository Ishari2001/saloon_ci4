<?php

namespace App\Controllers;

use App\Models\SiteSystemModel;

class Home extends BaseController
{
    public function index()
    {
        $system = (new SiteSystemModel())->find(1);

        return view('home', [
            'system'=>$system
        ]);
    }


}