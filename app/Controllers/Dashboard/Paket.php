<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\PaketModel;

class Paket extends BaseController
{
    protected $paketModel;

    public function __construct()
    {
        // Inisialisasi model PaketModel
        $this->paketModel = new PaketModel();
    }

    public function index()
    {
        // Mengambil semua data paket
        $data = [
            'title' => 'Paket Perjalanan',
            'packages' => $this->paketModel->getPaket(), // Mengambil semua paket
        ];

        // Menampilkan view dengan data paket
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar');
        echo view('admin/paket', $data); // Pastikan view ini ada untuk menampilkan daftar paket
        echo view('admin/Template/footer');
    }

    public function detail($id)
    {
        // Mengambil detail paket berdasarkan ID
        $data['package'] = $this->paketModel->getPaket($id);
        if (empty($data['package'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Paket tidak ditemukan');
        }

        $data['title'] = 'Detail Paket';
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar');
        echo view('admin/paket_detail', $data); // Buat view ini untuk menampilkan detail paket
        echo view('admin/Template/footer');
    }

    public function create()
    {
        // Menampilkan form untuk menambah paket
        $data['title'] = 'Tambah Paket';
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar');
        echo view('admin/paket_create'); // Buat view ini untuk form tambah paket
        echo view('admin/Template/footer');
    }

    public function store()
    {
        // Menyimpan data paket ke database
        $this->paketModel->save([
            'package_id' => $this->request->getPost('package_id'),
            'package_name' => $this->request->getPost('package_name'),
            'package_type' => $this->request->getPost('package_type'),
            'description' => $this->request->getPost('description'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Redirect ke halaman daftar paket setelah berhasil menyimpan
        return redirect()->to('/dashboard/paket');
    }

    public function edit($id)
    {
        // Mengambil data paket berdasarkan ID untuk di-edit
        $data['package'] = $this->paketModel->getPaket($id);
        if (empty($data['package'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Paket tidak ditemukan');
        }

        $data['title'] = 'Edit Paket';
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar');
        echo view('admin/paket_edit', $data); // Buat view ini untuk form edit paket
        echo view('admin/Template/footer');
    }

    public function update()
    {
        // Mengupdate data paket berdasarkan ID
        $id = $this->request->getPost('package_id');

        $this->paketModel->save([
            'package_id' => $this->request->getPost('package_id'),
            'package_name' => $this->request->getPost('package_name'),
            'package_type' => $this->request->getPost('package_type'),
            'description' => $this->request->getPost('description'),
            'created_at' => $this->request->getPost('created_at'), // Bisa disesuaikan
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Redirect ke halaman daftar paket setelah update
        return redirect()->to('/dashboard/paket');
    }

    public function delete($id)
    {
        // Menghapus paket berdasarkan ID
        $this->paketModel->hapus($id);
        return redirect()->to('/dashboard/paket');
    }
}
