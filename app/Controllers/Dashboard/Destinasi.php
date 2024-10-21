<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\DestinasiModel;
use App\Models\PaketModel;

class Destinasi extends BaseController
{
    protected $destinasiModel;
    protected $roleLabel; // Add property for roleLabel

    public function __construct()
    {
        // Inisialisasi model DestinasiModel
        $this->destinasiModel = new DestinasiModel();
        // Set roleLabel based on the session role
        $this->roleLabel = (session()->get('user_role') === 'owner') ? 'Super Admin' : 'Admin';
    }

    public function index()
    {
        // Mengambil semua data destinasi
        $data = [
            'title' => 'Destinasi Perjalanan',
            'destinasi' => $this->destinasiModel->getDestinasi(), // Mengambil semua destinasi
            'roleLabel' => $this->roleLabel, // Use the roleLabel
        ];

        // Menampilkan view dengan data destinasi
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data); // Pass roleLabel to sidebar
        echo view('admin/destinasi', $data); // Pastikan view ini ada untuk menampilkan daftar destinasi
        echo view('admin/Template/footer');
    }

    public function create()
    {
        // Ambil data packages
        $paketModel = new PaketModel();
        $data['packages'] = $paketModel->findAll(); // Ambil semua data packages

        // Ambil kode destinasi terakhir
        $lastDestinasi = $this->destinasiModel->orderBy('destination_id', 'DESC')->first();

        // Jika ada kode destinasi, increment. Jika tidak, mulai dari D01.
        if ($lastDestinasi) {
            $lastIdNumber = (int)substr($lastDestinasi['destination_id'], 1); // Ambil angka setelah 'D'
            $newIdNumber = $lastIdNumber + 1; // Increment angka
            $newDestinasiId = 'D' . str_pad($newIdNumber, 2, '0', STR_PAD_LEFT); // Format menjadi D01, D02, dll.
        } else {
            // Jika belum ada data, mulai dari D01
            $newDestinasiId = 'D01';
        }

        // Kirim data ke view
        $data['newDestinasiId'] = $newDestinasiId;
        $data['title'] = 'Tambah Destinasi';
        $data['roleLabel'] = $this->roleLabel; // Use the roleLabel
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data); // Pass roleLabel to sidebar
        echo view('admin/destinasi_create', $data); // Pastikan view ini ada
        echo view('admin/Template/footer');
    }

    public function store()
    {
        $filePhotos = $this->request->getFiles(); // Dapatkan semua file
        $fileNames = []; // Array untuk menyimpan nama file yang berhasil diupload

        foreach ($filePhotos['foto'] as $filePhoto) {
            if ($filePhoto && $filePhoto->isValid() && !$filePhoto->hasMoved()) {
                // Tentukan nama acak untuk setiap file
                $fileName = $filePhoto->getRandomName();
                // Pindahkan file ke folder uploads
                $filePhoto->move('uploads/destinasi/', $fileName);
                // Simpan nama file ke array
                $fileNames[] = $fileName;
            }
        }

        // Jika semua file berhasil diupload, simpan ke database
        if (!empty($fileNames)) {
            // Gabungkan nama file menjadi string, pisahkan dengan koma (opsional, atau bisa disimpan sebagai array JSON)
            $foto = implode(',', $fileNames);

            $package_id = $this->request->getPost('package_id');

            // Validasi package_id
            $paketModel = new PaketModel();
            $package = $paketModel->find($package_id);

            if (!$package) {
                // Jika package_id tidak valid, redirect dengan pesan error
                return redirect()->back()->with('error', 'Paket yang dipilih tidak valid.');
            }

            // Jika valid, lanjutkan proses penyimpanan
            $data = [
                'destination_id' => $this->request->getPost('destination_id'), // Pastikan ini benar
                'package_id' => $this->request->getPost('package_id'), // Foreign key yang valid
                'destination_name' => $this->request->getPost('destination_name'),
                'location' => $this->request->getPost('location'),
                'description' => $this->request->getPost('description'),
                'foto' => $foto,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->destinasiModel->save($data);
        }

        // Redirect ke halaman sukses atau tampilan lain
        return redirect()->to('/bali/destinasi');
    }

    public function edit($id)
    {
        // Mengambil data destinasi berdasarkan ID untuk di-edit
        $data['destinasi'] = $this->destinasiModel->getDestinasi($id);
        if (empty($data['destinasi'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Destinasi tidak ditemukan');
        }

        $data['title'] = 'Edit Destinasi';
        $data['roleLabel'] = $this->roleLabel; // Use the roleLabel
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data); // Pass roleLabel to sidebar
        echo view('admin/destinasi_edit', $data); // Buat view ini untuk form edit destinasi
        echo view('admin/Template/footer');
    }

    public function update()
    {
        // Mengupdate data destinasi berdasarkan ID
        $id = $this->request->getPost('destination_id');
        $data = [
            'destination_name' => $this->request->getPost('destination_name'),
            'location' => $this->request->getPost('location'),
            'description' => $this->request->getPost('description'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->destinasiModel->update($id, $data);

        // Redirect ke halaman daftar destinasi setelah update
        return redirect()->to('/bali/destinasi');
    }

    public function delete($id)
    {
        // Mengecek apakah data ada sebelum menghapus
        if (!$this->destinasiModel->find($id)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Destinasi tidak ditemukan');
        }

        // Menghapus destinasi berdasarkan ID
        $this->destinasiModel->delete($id);
        return redirect()->to('/bali/destinasi');
    }
}
