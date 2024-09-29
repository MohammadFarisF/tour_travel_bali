<?php

namespace App\Controllers;

class Dashboard extends BaseController
{

    public function index()
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
