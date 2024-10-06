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
        if (!session()->get('user_role') || session()->get('user_role') !== 'customer') {
        }
    
        // Ambil data customer dari model
        $data = [
            'title' => 'Data Customer',
            'customer' => $this->userModel->getUser(), // Panggil method getAdmin() untuk mendapatkan admin saja
        ];
    
        // Tampilkan tampilan template dengan data admin
        echo view('admin/Template/header', $data);   // Header dengan judul halaman
        echo view('admin/Template/sidebar');         // Sidebar yang digunakan
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
