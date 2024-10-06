<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\reviewmodel;

class Review extends BaseController
{
    protected $reviewModel;

    public function __construct()
    {
        // Inisialisasi model
        $this->reviewModel = new reviewmodel();
    }

    // Method untuk menampilkan data review
    public function index()
    {
        // Ambil data review dari model
        $data = [
            'title' => 'Data Review',
            'review' => $this->reviewModel->getReview(), 
        ];
    
        // Tampilkan tampilan template dengan data admin
        echo view('admin/Template/header', $data);   // Header dengan judul halaman
        echo view('admin/Template/sidebar');         // Sidebar yang digunakan
        echo view('admin/review', $data);             // Isi halaman admin dengan data review yang diambil
        echo view('admin/Template/footer');          // Footer
    }

    // Method untuk menghapus data review
    public function delete($id)
    {
        // Mengecek apakah data ada sebelum menghapus
        if (!$this->reviewModel->find($id)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Ulasan Customer tidak ditemukan');
        }
        
        // Menghapus destinasi berdasarkan ID
        $this->reviewModel->delete($id);
        return redirect()->to('/bali/review');
    }

}
