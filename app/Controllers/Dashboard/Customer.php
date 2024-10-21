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
        // Cek apakah user memiliki role admin
        $roleLabel = (session()->get('user_role') === 'owner') ? 'Super Admin' : 'Admin';

        // Ambil data customer dari model
        $data = [
            'title' => 'Data Customer',
            'customer' => $this->userModel->getUser(),
            'roleLabel' => $roleLabel,
        ];

        // Tampilkan tampilan template dengan data admin
        echo view('admin/Template/header', $data);   // Header dengan judul halaman
        echo view('admin/Template/sidebar', $data);       // Sidebar yang digunakan
        echo view('admin/customer', $data);             // Isi halaman admin dengan data admin yang diambil
        echo view('admin/Template/footer');          // Footer
    }

    // Method untuk menghapus data customer
    public function delete($id)
    {
        // Mengecek apakah data ada sebelum menghapus
        if (!$this->userModel->find($id)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Customer tidak ditemukan');
        }

        // Menghapus destinasi berdasarkan ID
        $this->userModel->delete($id);
        return redirect()->to('/bali/customer');
    }
}
