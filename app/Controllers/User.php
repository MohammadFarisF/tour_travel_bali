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
    public function service()
    {
        echo view('user/service');
    }
    public function testimonial()
    {
        echo view('user/testimonial');
    }
    public function documentation()
    {
        echo view('user/documentation');
    }
}
