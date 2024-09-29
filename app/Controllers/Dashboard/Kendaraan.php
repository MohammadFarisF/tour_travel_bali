<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Kendaraan extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Kendaraan',
        ];
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar');
        echo view('admin/kendaraan');
        echo view('admin/Template/footer');
    }
}
