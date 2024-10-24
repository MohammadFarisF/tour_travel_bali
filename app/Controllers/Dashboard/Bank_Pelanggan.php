<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\bankpelangganmodel;

class Bank_Pelanggan extends BaseController
{
    protected $bankpelangganModel;

    public function __construct()
    {
        // Inisialisasi model bank pelangganModel
        $this->bankpelangganModel = new bankpelangganmodel();
    }

    public function index()
    {
        // Cek role dan tentukan label yang akan muncul
        $roleLabel = (session()->get('user_role') === 'owner') ? 'Super Admin' : 'Admin';
        // Mengambil semua data bank pelanggan
        $data = [
            'title' => 'Bank Pelanggan',
            'bankpelanggan' => $this->bankpelangganModel->getbankpelanggan(), // Mengambil semua bank pelanggan
            'roleLabel' => $roleLabel, // Label role (Admin/Super Admin)
        ];

        // Menampilkan view dengan data bank pelanggan
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data);
        echo view('admin/bankpelanggan', $data); // Pastikan view ini ada untuk menampilkan daftar bank pelanggan
        echo view('admin/Template/footer');
    }

    public function delete($id)
    {
        // Menghapus bank pelanggan berdasarkan ID
        $this->bankpelangganModel->hapus($id);
        return redirect()->to('/bali/bankpelanggan');
    }
}
