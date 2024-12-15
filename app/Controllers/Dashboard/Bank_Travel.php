<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\banktravelmodel;

class Bank_Travel extends BaseController
{
    protected $banktravelModel;
    protected $roleLabel; // Declare roleLabel as a class property

    public function __construct()
    {
        // Inisialisasi model travelModel
        $this->banktravelModel = new banktravelmodel();

        // Set the role label based on the session
        $this->roleLabel = (session()->get('user_role') === 'owner') ? 'Super Admin' : 'Admin';
    }

    public function index()
    {
        if (session()->get('user_role') !== 'owner') {
            return redirect()->to(base_url('/bali'))->with('dilarang_masuk', 'Anda tidak memiliki akses untuk ke halaman ini.');
        }
        // Mengambil semua data travel
        $data = [
            'title' => 'Bank Travel',
            'banktravel' => $this->banktravelModel->getbanktravel(), // Mengambil semua travel
            'roleLabel' => $this->roleLabel, // Use the class property
        ];

        // Menampilkan view dengan data travel
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data);
        echo view('admin/banktravel', $data); // Pastikan view ini ada untuk menampilkan daftar travel
        echo view('admin/Template/footer');
    }

    public function create()
    {
        if (session()->get('user_role') !== 'owner') {
            return redirect()->to(base_url('/bali'))->with('dilarang_masuk', 'Anda tidak memiliki akses untuk ke halaman ini.');
        }
        $data['title'] = 'Tambah Bank Travel';
        $data['roleLabel'] = $this->roleLabel; // Include roleLabel in the data

        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data);
        echo view('admin/banktravel_create'); // Create this view for adding new vehicle
        echo view('admin/Template/footer');
    }

    public function store()
    {
        if (session()->get('user_role') !== 'owner') {
            return redirect()->to(base_url('/bali'))->with('dilarang_masuk', 'Anda tidak memiliki akses untuk ke halaman ini.');
        }
        $filePhoto = $this->request->getFile('photo');

        // Tentukan nama file yang akan disimpan
        $fileName = '';
        if ($filePhoto && $filePhoto->isValid() && !$filePhoto->hasMoved()) {
            // Pindahkan file ke folder uploads dengan nama asli
            $fileName = $filePhoto->getRandomName(); // Buat nama file acak
            $filePhoto->move('uploads/banktravel', $fileName); // Simpan file ke folder uploads
        }

        // Menyimpan data travel ke database
        $this->banktravelModel->save([
            'trabank_id' => $this->request->getPost('trabank_id'),
            'account_number' => $this->request->getPost('account_number'),
            'account_holder_name' => $this->request->getPost('account_holder_name'),
            'bank_name' => $this->request->getPost('bank_name'),
            'photo' => $fileName,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => NULL
        ]);

        // Redirect ke halaman daftar travel setelah berhasil menyimpan
        return redirect()->to(base_url('/bali/banktravel'));
    }

    public function edit($id)
    {
        if (session()->get('user_role') !== 'owner') {
            return redirect()->to(base_url('/bali'))->with('dilarang_masuk', 'Anda tidak memiliki akses untuk ke halaman ini.');
        }
        // Mengambil data travel berdasarkan ID untuk di-edit
        $data['banktravel'] = $this->banktravelModel->getbanktravel($id);
        if (empty($data['banktravel'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('bank travel tidak ditemukan');
        }

        $data['title'] = 'Edit Bank Travel';
        $data['roleLabel'] = $this->roleLabel; // Include roleLabel in the data

        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data);
        echo view('admin/banktravel_edit', $data); // Buat view ini untuk form edit travel
        echo view('admin/Template/footer');
    }

    public function update($id)
    {
        if (session()->get('user_role') !== 'owner') {
            return redirect()->to(base_url('/bali'))->with('dilarang_masuk', 'Anda tidak memiliki akses untuk ke halaman ini.');
        }
        // Tangani upload file foto baru (jika ada)
        $filePhoto = $this->request->getFile('photo');
        if ($filePhoto && $filePhoto->isValid() && !$filePhoto->hasMoved()) {
            // Pindahkan file ke folder uploads
            $fileName = $filePhoto->getRandomName();
            $filePhoto->move('uploads/banktravel', $fileName);
        } else {
            // Jika tidak ada file baru, tetap gunakan file yang lama
            $fileName = $this->request->getPost('existing_photo');
        }

        // Update data bank travel di database dengan kondisi WHERE menggunakan trabank_id
        $this->banktravelModel->where('trabank_id', $id)->update($id, [
            'account_number' => $this->request->getPost('account_number'),
            'account_holder_name' => $this->request->getPost('account_holder_name'),
            'bank_name' => $this->request->getPost('bank_name'),
            'photo' => $fileName, // Simpan nama file baru atau tetap yang lama
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Redirect ke halaman daftar bank travel setelah update
        return redirect()->to(base_url('/bali/banktravel'));
    }

    public function delete($id)
    {
        if (session()->get('user_role') !== 'owner') {
            return redirect()->to(base_url('/bali'))->with('dilarang_masuk', 'Anda tidak memiliki akses untuk ke halaman ini.');
        }
        // Cari data kendaraan berdasarkan ID
        $banktravel = $this->banktravelModel->find($id);

        if ($banktravel) {
            // Ambil nama file foto dari database
            $fotoPath = $banktravel['photo'];

            // Tentukan lokasi file di folder 'uploads'
            $filePath = WRITEPATH . '../public/uploads/banktravel' . $fotoPath;

            // Cek apakah file ada di folder dan hapus file tersebut
            if (file_exists($filePath) && !empty($fotoPath)) {
                unlink($filePath); // Menghapus file
            }

            // Hapus data kendaraan dari database
            $this->banktravelModel->delete($id);

            // Redirect setelah penghapusan berhasil
            return redirect()->to(base_url('/bali/banktravel'))->with('message', 'Data Travel bank dan foto berhasil dihapus');
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akun Travel tidak ditemukan');
        }
    }
}
