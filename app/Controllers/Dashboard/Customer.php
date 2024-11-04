<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CustModel;

class Customer extends BaseController
{
    protected $CustomerModel;

    public function __construct()
    {
        // Inisialisasi model
        $this->CustomerModel = new CustModel();
    }

    // Method untuk menampilkan data customer
    public function index()
    {
        // Cek apakah user memiliki role admin
        $roleLabel = (session()->get('user_role') === 'owner') ? 'Super Admin' : 'Admin';
        if (session()->get('user_role') !== 'owner') {
            return redirect()->to(base_url('/bali'))->with('dilarang_masuk', 'Anda tidak memiliki akses untuk ke halaman ini.');
        }
        // Ambil data customer dari model
        $data = [
            'title' => 'Data Customer',
            'customer' => $this->CustomerModel->getCustomer(),
            'roleLabel' => $roleLabel,
        ];

        // Tampilkan tampilan template dengan data admin
        echo view('admin/Template/header', $data);   // Header dengan judul halaman
        echo view('admin/Template/sidebar', $data);       // Sidebar yang digunakan
        echo view('admin/customer', $data);             // Isi halaman admin dengan data admin yang diambil
        echo view('admin/Template/footer');          // Footer
    }
}
