<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\bookingmodel;

class Booking extends BaseController
{
    protected $bookingModel;

    public function __construct()
    {
        // Inisialisasi model bank pelangganModel
        $this->bookingModel = new bookingmodel();
    }

    public function index()
    {
        $roleLabel = (session()->get('user_role') === 'owner') ? 'Super Admin' : 'Admin';
        // Mengambil semua data bank pelanggan
        $data = [
            'title' => 'Pemesanan',
            'bookings' => $this->bookingModel->getBooking(),
            'roleLabel' => $roleLabel, // Mengambil semua bank pelanggan
        ];

        // Menampilkan view dengan data bank pelanggan
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data);
        echo view('admin/booking', $data); // Pastikan view ini ada untuk menampilkan daftar bank pelanggan
        echo view('admin/Template/footer');
    }
}
