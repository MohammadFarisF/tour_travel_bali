<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\paketmodel;

class Paket extends BaseController
{
    protected $paketModel;
    protected $roleLabel;

    public function __construct()
    {
        // Inisialisasi model PaketModel
        $this->paketModel = new paketmodel();
        $this->roleLabel = (session()->get('user_role') === 'owner') ? 'Super Admin' : 'Admin';
    }

    public function index()
    {
        // Mengambil semua data paket
        $data = [
            'title' => 'Paket Perjalanan',
            'packages' => $this->paketModel->getpaket(),
            'roleLabel' => $this->roleLabel
        ];

        // Menampilkan view dengan data paket
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data);
        echo view('admin/paket', $data); // Pastikan view ini ada untuk menampilkan daftar paket
        echo view('admin/Template/footer');
    }

    public function create()
    {
        if (session()->get('user_role') !== 'owner') {
            return redirect()->to(base_url('/bali'))->with('dilarang_masuk', 'Anda tidak memiliki akses untuk ke halaman ini.');
        }
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
        $data['roleLabel'] = $this->roleLabel;
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data);
        echo view('admin/paket_create', $data); // Pastikan view ini ada
        echo view('admin/Template/footer');
    }


    public function store()
    {
        if (session()->get('user_role') !== 'owner') {
            return redirect()->to(base_url('/bali'))->with('dilarang_masuk', 'Anda tidak memiliki akses untuk ke halaman ini.');
        }
        $filePhoto = $this->request->getFile('foto');

        // Tentukan nama file yang akan disimpan
        $fileName = '';
        if ($filePhoto && $filePhoto->isValid() && !$filePhoto->hasMoved()) {
            // Pindahkan file ke folder uploads dengan nama asli
            $fileName = $filePhoto->getRandomName(); // Buat nama file acak
            $filePhoto->move('uploads/paket', $fileName); // Simpan file ke folder uploads
        }
        // Menyimpan data paket ke database
        $this->paketModel->save([
            'package_id' => $this->request->getPost('package_id'),
            'package_name' => $this->request->getPost('package_name'),
            'package_type' => $this->request->getPost('package_type'),
            'description' => $this->request->getPost('description'),
            'foto' => $fileName,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => NULL
        ]);

        // Redirect ke halaman daftar paket setelah berhasil menyimpan
        return redirect()->to(base_url('/bali/paket'));
    }

    public function edit($id)
    {
        if (session()->get('user_role') !== 'owner') {
            return redirect()->to(base_url('/bali'))->with('dilarang_masuk', 'Anda tidak memiliki akses untuk ke halaman ini.');
        }
        // Mengambil data paket berdasarkan ID untuk di-edit
        $data['package'] = $this->paketModel->getpaket($id);
        if (empty($data['package'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Paket tidak ditemukan');
        }

        $data['title'] = 'Edit Paket';
        $data['roleLabel'] = $this->roleLabel;
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data);
        echo view('admin/paket_edit', $data); // Buat view ini untuk form edit paket
        echo view('admin/Template/footer');
    }

    public function update()
    {
        if (session()->get('user_role') !== 'owner') {
            return redirect()->to(base_url('/bali'))->with('dilarang_masuk', 'Anda tidak memiliki akses untuk ke halaman ini.');
        }
        // Mengupdate data paket berdasarkan ID
        $id = $this->request->getPost('package_id');
        $package = $this->paketModel->find($id);
        if (!$package) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kendaraan tidak ditemukan');
        }
        $data = [
            'package_name' => $this->request->getPost('package_name'),
            'package_type' => $this->request->getPost('package_type'),
            'description' => $this->request->getPost('description'),
            'created_at' => $this->request->getPost('created_at'), // Bisa disesuaikan
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $filePhoto = $this->request->getFile('foto');

        // Jika ada file foto baru yang diunggah
        if ($filePhoto && $filePhoto->isValid() && !$filePhoto->hasMoved()) {
            // Hapus foto lama jika ada
            if (!empty($package['foto'])) {
                $oldFilePath = 'uploads/paket/' . $package['foto'];
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); // Menghapus file lama
                }
            }

            // Pindahkan file ke folder uploads dengan nama baru
            $fileName = $filePhoto->getRandomName(); // Buat nama file acak
            $filePhoto->move('uploads/paket', $fileName); // Simpan file ke folder uploads
            $data['foto'] = $fileName; // Tambahkan nama file baru ke data
        } else {
            // Jika tidak ada file baru, tetap gunakan foto lama
            $data['foto'] = $package['foto'];
        }

        $this->paketModel->update($id, $data);

        // Redirect ke halaman daftar paket setelah update
        return redirect()->to(base_url('/bali/paket'));
    }

    public function delete($id)
    {
        if (session()->get('user_role') !== 'owner') {
            return redirect()->to(base_url('/bali'))->with('dilarang_masuk', 'Anda tidak memiliki akses untuk ke halaman ini.');
        }
        // Menghapus paket berdasarkan ID
        $package = $this->paketModel->find($id);

        if ($package) {
            // Ambil nama file foto dari database
            $fotoPath = $package['foto'];

            // Tentukan lokasi file di folder 'uploads'
            $filePath = FCPATH . 'uploads/paket/' . $fotoPath;

            // Cek apakah file ada di folder dan hapus file tersebut
            if (file_exists($filePath) && !empty($fotoPath)) {
                unlink($filePath); // Menghapus file
            }

            // Hapus data kendaraan dari database
            $this->paketModel->delete($id);

            // Redirect setelah penghapusan berhasil
            return redirect()->to(base_url('/bali/paket'))->with('message', 'Data paket dan foto berhasil dihapus');
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Paket tidak ditemukan');
        }
    }
}
