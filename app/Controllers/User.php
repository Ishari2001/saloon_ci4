<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        return view('user_form');
    }

    public function save()
    {
        $model = new UserModel();

        $data = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email')
        ];

        if (!$model->saveUser($data)) {
            return view('user_form', [
                'errors' => $model->errors()
            ]);
        }

        return redirect()->to(base_url('user/list'));
    }

    public function list()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();

        return view('user_list', $data);
    }
}
