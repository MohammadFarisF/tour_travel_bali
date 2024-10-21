<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\kendaraanmodel;

class Kendaraan extends BaseController
{
    protected $kendaraanModel;
    protected $roleLabel;

    public function __construct()
    {
        $this->kendaraanModel = new kendaraanmodel();
        // Set roleLabel based on the session role
        $this->roleLabel = (session()->get('user_role') === 'owner') ? 'Super Admin' : 'Admin';
    }

    public function index()
    {
        $data = [
            'title' => 'Kendaraan',
            'kendaraan' => $this->kendaraanModel->getkendaraan(),
            'roleLabel' => $this->roleLabel, // Use the roleLabel
        ];

        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data);
        echo view('admin/kendaraan', $data); // Make sure this view displays the vehicle list
        echo view('admin/Template/footer');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kendaraan',
            'roleLabel' => $this->roleLabel
        ];

        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data);
        echo view('admin/kendaraan_create'); // Create this view for adding new vehicle
        echo view('admin/Template/footer');
    }

    public function store()
    {

        // Mengambil file foto kendaraan dari form
        $filePhoto = $this->request->getFile('vehicle_photo');

        // Tentukan nama file yang akan disimpan
        $fileName = '';
        if ($filePhoto && $filePhoto->isValid() && !$filePhoto->hasMoved()) {
            // Pindahkan file ke folder uploads dengan nama asli
            $fileName = $filePhoto->getRandomName(); // Buat nama file acak
            $filePhoto->move('uploads/kendaraan', $fileName); // Simpan file ke folder uploads
        }

        // Simpan data ke database
        $this->kendaraanModel->save([
            'vehicle_name' => $this->request->getPost('vehicle_name'),
            'license_plate' => $this->request->getPost('license_plate'),
            'capacity' => $this->request->getPost('capacity'),
            'vehicle_type' => $this->request->getPost('vehicle_type'),
            'vehicle_photo' => $fileName, // Simpan nama file di database
            'status' => 'available',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/bali/kendaraan');
    }


    public function edit($id)
    {
        $data['kendaraan'] = $this->kendaraanModel->getkendaraan($id);
        if (empty($data['kendaraan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kendaraan tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Kendaraan',
            'roleLabel' => $this->roleLabel
        ];

        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data);
        echo view('admin/kendaraan_edit', $data); // Create this view for editing
        echo view('admin/Template/footer');
    }

    public function update($id)
    {
        // Ambil data kendaraan yang ada berdasarkan ID
        $kendaraan = $this->kendaraanModel->find($id);
        if (!$kendaraan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kendaraan tidak ditemukan');
        }

        // Ambil data dari form
        $data = [
            'vehicle_name' => $this->request->getPost('vehicle_name'),
            'license_plate' => $this->request->getPost('license_plate'),
            'capacity' => $this->request->getPost('capacity'),
            'vehicle_type' => $this->request->getPost('vehicle_type'),
            'status' => $this->request->getPost('status'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Mengambil file foto kendaraan dari form
        $filePhoto = $this->request->getFile('vehicle_photo');

        // Jika ada file foto baru yang diunggah
        if ($filePhoto && $filePhoto->isValid() && !$filePhoto->hasMoved()) {
            // Hapus foto lama jika ada
            if (!empty($kendaraan['vehicle_photo'])) {
                $oldFilePath = 'uploads/kendaraan/' . $kendaraan['vehicle_photo'];
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); // Menghapus file lama
                }
            }

            // Pindahkan file ke folder uploads dengan nama baru
            $fileName = $filePhoto->getRandomName(); // Buat nama file acak
            $filePhoto->move('uploads/kendaraan', $fileName); // Simpan file ke folder uploads
            $data['vehicle_photo'] = $fileName; // Tambahkan nama file baru ke data
        } else {
            // Jika tidak ada file baru, tetap gunakan foto lama
            $data['vehicle_photo'] = $kendaraan['vehicle_photo'];
        }

        // Update data ke database
        $this->kendaraanModel->update($id, $data);

        return redirect()->to('/bali/kendaraan'); // Redirect setelah sukses
    }

    public function delete($id)
    {
        // Cari data kendaraan berdasarkan ID
        $kendaraan = $this->kendaraanModel->find($id);

        if ($kendaraan) {
            // Ambil nama file foto dari database
            $fotoPath = $kendaraan['vehicle_photo'];

            // Tentukan lokasi file di folder 'uploads'
            $filePath = WRITEPATH . '../public/uploads/' . $fotoPath;

            // Cek apakah file ada di folder dan hapus file tersebut
            if (file_exists($filePath) && !empty($fotoPath)) {
                unlink($filePath); // Menghapus file
            }

            // Hapus data kendaraan dari database
            $this->kendaraanModel->delete($id);

            // Redirect setelah penghapusan berhasil
            return redirect()->to('/bali/kendaraan')->with('message', 'Data kendaraan dan foto berhasil dihapus');
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kendaraan tidak ditemukan');
        }
    }
}
