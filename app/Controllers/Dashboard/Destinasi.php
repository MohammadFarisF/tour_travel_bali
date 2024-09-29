<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Destinasi extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Destinasi',
        ];
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar');
        echo view('admin/destinasi');
        echo view('admin/Template/footer');
    }
}
