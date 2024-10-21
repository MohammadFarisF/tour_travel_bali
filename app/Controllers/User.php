<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class User extends BaseController
{

    public function index()
    {
        echo view('user/template/header');
        echo view('user/index');
        echo view('user/template/footer');
    }

    public function about()
    {
        echo view('user/template/header');
        echo view('user/about');
        echo view('user/template/footer');
    }

    public function booking()
    {
        echo view('user/template/header');
        echo view('user/booking');
        echo view('user/template/footer');
    }
    public function contact()
    {
        echo view('user/template/header');
        echo view('user/contact');
        echo view('user/template/footer');
    }
    public function payment()
    {
        echo view('user/template/header');
        echo view('user/payment');
        echo view('user/template/footer');
    }
    public function change()
    {
        echo view('user/template/header');
        echo view('user/change');
        echo view('user/template/footer');
    }
    public function order_data()
    {
        echo view('user/template/header');
        echo view('user/order_data');
        echo view('user/template/footer');
    }
    public function review()
    {
        echo view('user/template/header');
        echo view('user/review');
        echo view('user/template/footer');
    }
}
