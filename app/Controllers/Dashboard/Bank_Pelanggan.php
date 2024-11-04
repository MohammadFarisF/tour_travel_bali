<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CustModel;

class Bank_Pelanggan extends BaseController
{
    protected $customerModel;

    public function __construct()
    {
        // Inisialisasi model bank pelangganModel
        $this->customerModel = new CustModel();
    }

    public function index()
    {
        // Cek role dan tentukan label yang akan muncul
        $roleLabel = (session()->get('user_role') === 'owner') ? 'Super Admin' : 'Admin';
        // Mengambil semua data bank pelanggan
        if (session()->get('user_role') !== 'owner') {
            return redirect()->to(base_url('/bali'))->with('dilarang_masuk', 'Anda tidak memiliki akses untuk ke halaman ini.');
        }
        $data = [
            'title' => 'Bank Pelanggan',
            'bankpelanggan' => $this->customerModel->getBank(), // Mengambil semua bank pelanggan
            'roleLabel' => $roleLabel, // Label role (Admin/Super Admin)
        ];

        // Menampilkan view dengan data bank pelanggan
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data);
        echo view('admin/bankpelanggan', $data); // Pastikan view ini ada untuk menampilkan daftar bank pelanggan
        echo view('admin/Template/footer');
    }
}
