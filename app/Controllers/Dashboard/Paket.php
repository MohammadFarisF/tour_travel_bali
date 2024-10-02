<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\paketmodel;

class Paket extends BaseController
{
    protected $paketModel;

    public function __construct()
    {
        // Inisialisasi model PaketModel
        $this->paketModel = new paketmodel();
    }

    public function index()
    {
        // Mengambil semua data paket
        $data = [
            'title' => 'Paket Perjalanan',
            'packages' => $this->paketModel->getpaket(), // Mengambil semua paket
        ];

        // Menampilkan view dengan data paket
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar');
        echo view('admin/paket', $data); // Pastikan view ini ada untuk menampilkan daftar paket
        echo view('admin/Template/footer');
    }

    public function create()
    {
        // Ambil kode paket terakhir
        $lastPackage = $this->paketModel->orderBy('package_id', 'DESC')->first();

        // Jika ada kode paket, increment. Jika tidak, mulai dari P01.
        if ($lastPackage) {
            $lastIdNumber = (int)substr($lastPackage['package_id'], 1); // Ambil angka setelah 'P'
            $newIdNumber = $lastIdNumber + 1; // Increment angka
            $newPackageId = 'P' . str_pad($newIdNumber, 2, '0', STR_PAD_LEFT); // Format menjadi P01, P02, dll.
        } else {
            // Jika belum ada data, mulai dari P01
            $newPackageId = 'P01';
        }

        // Kirim data ke view
        $data['newPackageId'] = $newPackageId;
        $data['title'] = 'Tambah Paket';
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar');
        echo view('admin/paket_create', $data); // Pastikan view ini ada
        echo view('admin/Template/footer');
    }


    public function store()
    {
        // Menyimpan data paket ke database
        $this->paketModel->save([
            'package_name' => $this->request->getPost('package_name'),
            'package_type' => $this->request->getPost('package_type'),
            'description' => $this->request->getPost('description'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => NULL
        ]);

        // Redirect ke halaman daftar paket setelah berhasil menyimpan
        return redirect()->to('/bali/paket');
    }

    public function edit($id)
    {
        // Mengambil data paket berdasarkan ID untuk di-edit
        $data['package'] = $this->paketModel->getpaket($id);
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
<<<<<<< Updated upstream

        $this->paketModel->simpan([
            'package_id' => $id,
            'package_name' => $this->request->getPost('package_name'),
            'package_type' => $this->request->getPost('package_type'),
            'description' => $this->request->getPost('description'),
            'created_at' => $this->request->getPost('created_at'), // Bisa disesuaikan
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
=======
    $data = [
    'package_name' => $this->request->getPost('package_name'),
    'package_type' => $this->request->getPost('package_type'),
    'description' => $this->request->getPost('description'),
    'created_at' => $this->request->getPost('created_at'), // Bisa disesuaikan
    'updated_at' => date('Y-m-d H:i:s')
];
        $this->paketModel->update($id, $data);
>>>>>>> Stashed changes

        // Redirect ke halaman daftar paket setelah update
        return redirect()->to('/bali/paket');
    }

    public function delete($id)
    {
        // Menghapus paket berdasarkan ID
        $this->paketModel->hapus($id);
        return redirect()->to('/bali/paket');
    }
}
