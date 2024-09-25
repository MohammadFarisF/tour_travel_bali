<?php

namespace App\Controllers;

use App\Models\UsersModel;
use SebastianBergmann\Template\Template;

class Home extends BaseController
{
    public function user()
    {
        echo view('user/index');
    }

    public function admin()
    {

        $data = [
            'title' => 'Dashboard',
        ];
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar');
        echo view('admin/index');
        echo view('admin/Template/footer');
    }
}
