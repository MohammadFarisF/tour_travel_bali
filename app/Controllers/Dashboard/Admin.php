<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\adminmodel;

class Admin extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new adminModel();
    }

    public function index()
    {
        // Cek apakah user memiliki role admin
        if (!session()->get('user_role') || session()->get('user_role') !== 'admin') {
        }
    
        // Ambil data admin dari model
        $data = [
            'title' => 'Admin',
            'admin' => $this->adminModel->getAdmin(), // Panggil method getAdmin() untuk mendapatkan admin saja
        ];
    
        // Tampilkan tampilan template dengan data admin
        echo view('admin/Template/header', $data);   // Header dengan judul halaman
        echo view('admin/Template/sidebar');         // Sidebar yang digunakan
        echo view('admin/admin', $data);             // Isi halaman admin dengan data admin yang diambil
        echo view('admin/Template/footer');          // Footer
    }

    public function create()
    {
                // Ambil kode destinasi terakhir
                $lastadmin = $this->adminModel->orderBy('user_id', 'DESC')->first();

                // Jika ada kode destinasi, increment. Jika tidak, mulai dari P01.
                if ($lastadmin) {
                    $lastIdNumber = (int)substr($lastadmin['user_id'], 1); // Ambil angka setelah 'P'
                    $newIdNumber = $lastIdNumber + 1; // Increment angka
                    $newIdUser = 'U' . str_pad($newIdNumber, 3, '0', STR_PAD_LEFT); // Format menjadi P01, P02, dll.
                } else {
                    // Jika belum ada data, mulai dari P01
                    $newIdUser = 'U001';
                }        
        $data['title'] = 'Tambah Admin';
        $data['newIdUser'] = $newIdUser;
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar');
        echo view('admin/admin_create'); // View untuk menambah admin baru
        echo view('admin/Template/footer');
    }

    public function store()
    {
        // Menyimpan data admin ke database
        $this->adminModel->save([
            'user_id' => $this->request->getPost('user_id'),
            'full_name' => $this->request->getPost('full_name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), // Hash password untuk keamanan
            'phone_number' => $this->request->getPost('phone_number'),
            'user_role' => 'admin', // Menyimpan role sebagai admin
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    
        // Redirect ke halaman daftar admin setelah berhasil menyimpan
        return redirect()->to('/bali/admin')->with('message', 'Admin berhasil ditambahkan');
    }
    

    public function edit($id)
    {
        $data['admin'] = $this->adminModel->getAdmin($id);
        if (empty($data['admin'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Admin tidak ditemukan');
        }

        $data['title'] = 'Edit Admin';
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar');
        echo view('admin/admin_edit', $data); // View untuk mengedit admin
        echo view('admin/Template/footer');
    }

    public function update($id)
    {
        // Cek apakah admin dengan ID yang diberikan ada
        $admin = $this->adminModel->find($id);
        if (!$admin) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Admin tidak ditemukan');
        }

        // Ambil data dari form
        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'phone_number' => $this->request->getPost('phone_number'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Update data di database
        $this->adminModel->update($id, $data);

        // Redirect setelah sukses
        return redirect()->to('/bali/admin')->with('message', 'Admin berhasil diupdate');
    }

    public function delete($id)
    {
        // Cek apakah admin dengan ID yang diberikan ada di database
        $admin = $this->adminModel->find($id);
        if (!$admin) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Admin tidak ditemukan');
        }

        // Hapus data admin dari database
        $this->adminModel->delete($id);

        // Redirect setelah sukses dihapus
        return redirect()->to('/bali/admin')->with('message', 'Admin berhasil dihapus');
    }
}
