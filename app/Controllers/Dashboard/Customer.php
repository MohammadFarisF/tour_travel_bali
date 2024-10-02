<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\usermodel;

class Customer extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        // Inisialisasi model
        $this->userModel = new usermodel();
    }

    // Method untuk menampilkan data customer
    public function index()
    {
        // Mengambil data customer dari model
        $data = [
            'title' => 'Data Customer',
            'customer' => $this->userModel->findAll(), // Mendapatkan semua data customer
        ];

        // Memuat view
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar');
        echo view('admin/customer', $data); // Menampilkan data ke tabel customer
        echo view('admin/Template/footer');
    }

    // Method untuk menghapus data customer
    public function delete($id)
    {
        // Mencari data customer berdasarkan ID
        $customer = $this->userModel->find($id);

        if ($customer) {
            // Jika data customer ditemukan, hapus
            $this->userModel->deleteCustomer($id);
            // Redirect dengan pesan sukses
            return redirect()->to('dashboard/customer')->with('message', 'Data customer berhasil dihapus.');
        }

        // Jika data tidak ditemukan, beri pesan error
        return redirect()->to('dashboard/customer')->with('error', 'Data customer tidak ditemukan.');
    }
}
