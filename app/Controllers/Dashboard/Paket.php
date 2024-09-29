<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Paket extends BaseController
{

    public function index()
    {

        $data = [
            'title' => 'Paket',
        ];
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar');
        echo view('admin/paket');
        echo view('admin/Template/footer');
    }
}
