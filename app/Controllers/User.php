<?php

namespace App\Controllers;

class User extends BaseController
{

    public function index()
    {
        echo view('user/index');
    }

    public function about()
    {
        echo view('user/about');
    }

    public function booking()
    {
        echo view('user/booking');
    }
    public function contact()
    {
        echo view('user/contact');
    }
    public function payment()
    {
        echo view('user/payment');
    }public function change()
    {
        echo view('user/change');
    }public function order_data()
    {
        echo view('user/order_data');
    }public function review()
    {
        echo view('user/review');
    }

}
