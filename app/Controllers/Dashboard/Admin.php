<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Admin extends BaseController
{
    protected $adminModel;
    protected $roleLabel; // Add a property for roleLabel

    public function __construct()
    {
        $this->adminModel = new adminmodel();
        // Set roleLabel once during construction
        $this->roleLabel = (session()->get('user_role') === 'owner') ? 'Super Admin' : 'Admin';
    }

    public function index()
    {
        if (session()->get('user_role') !== 'owner') {
            return redirect()->to(base_url('/bali'))->with('dilarang_masuk', 'Anda tidak memiliki akses untuk ke halaman ini.');
        }
        // Ambil data admin dari model
        $data = [
            'title' => 'Admin',
            'admin' => $this->adminModel->getAdmin(), // Panggil method getAdmin() untuk mendapatkan admin saja
            'roleLabel' => $this->roleLabel, // Use the property for role label
        ];

        // Tampilkan tampilan template dengan data admin
        echo view('admin/Template/header', $data);   // Header dengan judul halaman
        echo view('admin/Template/sidebar', $data);   // Sidebar yang digunakan
        echo view('admin/admin', $data);              // Isi halaman admin dengan data admin yang diambil
        echo view('admin/Template/footer');            // Footer
    }

    public function create()
    {
        if (session()->get('user_role') !== 'owner') {
            return redirect()->to(base_url('/bali'))->with('dilarang_masuk', 'Anda tidak memiliki akses untuk ke halaman ini.');
        }
        // Ambil kode destinasi terakhir
        $lastadmin = $this->adminModel->orderBy('user_id', 'DESC')->first();

        // Jika ada kode destinasi, increment. Jika tidak, mulai dari U001.
        if ($lastadmin) {
            $lastIdNumber = (int)substr($lastadmin['user_id'], 1); // Ambil angka setelah 'U'
            $newIdNumber = $lastIdNumber + 1; // Increment angka
            $newIdUser = 'U' . str_pad($newIdNumber, 3, '0', STR_PAD_LEFT); // Format menjadi U001, U002, dll.
        } else {
            // Jika belum ada data, mulai dari U001
            $newIdUser = 'U001';
        }

        $data['title'] = 'Tambah Admin';
        $data['newIdUser'] = $newIdUser;
        $data['roleLabel'] = $this->roleLabel; // Use the property for role label
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data); // Pass roleLabel to sidebar
        echo view('admin/admin_create'); // View untuk menambah admin baru
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
            $filePhoto->move('uploads/admin', $fileName); // Simpan file ke folder uploads
        }
        // Menyimpan data admin ke database
        $this->adminModel->save([
            'user_id' => $this->request->getPost('user_id'),
            'full_name' => $this->request->getPost('full_name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), // Hash password untuk keamanan
            'phone_number' => $this->request->getPost('phone_number'),
            'user_role' => $this->request->getPost('user_role'),
            'photo' => $fileName,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => NULL
        ]);

        // Redirect ke halaman daftar admin setelah berhasil menyimpan
        return redirect()->to(base_url('/bali/admin'))->with('create', 'Admin berhasil ditambahkan');
    }

    public function delete($id)
    {
        if (session()->get('user_role') !== 'owner') {
            return redirect()->to(base_url('/bali'))->with('dilarang_masuk', 'Anda tidak memiliki akses untuk ke halaman ini.');
        }
        // Cek apakah admin dengan ID yang diberikan ada di database
        $admin = $this->adminModel->find($id);
        if (!$admin) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Admin tidak ditemukan');
        }

        if (session()->get('user_id') == $id) {
            return redirect()->to(base_url('/bali/admin'))->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Hapus data admin dari database
        $this->adminModel->delete($id);

        // Redirect setelah sukses dihapus
        return redirect()->to(base_url('/bali/admin'))->with('delete', 'Admin berhasil dihapus');
    }
    public function profile()
    {
        // Mendapatkan data pengguna berdasarkan session login
        $userId = session()->get('userid');
        $data['user'] = $this->adminModel->find($userId);

        $data['title'] = 'Account Settings - Profile';
        $data['roleLabel'] = $this->roleLabel;

        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data);
        echo view('admin/account', $data);
        echo view('admin/Template/footer');
    }

    public function updateProfile()
    {
        $userId = session()->get('userid');
        $fullName = $this->request->getPost('full_name');
        $phone = $this->request->getPost('phone_number');

        // Menghapus awalan +62 dan mengubah kembali ke format 08...
        if (substr($phone, 0, 3) === '+62') {
            $phone = '0' . substr($phone, 3);
        }

        // Mengambil data pengguna saat ini
        $userData = $this->adminModel->find($userId);
        $oldPhoto = $userData['photo'];
        $filePhoto = $this->request->getFile('photo');
        $fileName = '';

        if ($filePhoto && $filePhoto->isValid() && !$filePhoto->hasMoved()) {
            $fileName = $filePhoto->getRandomName();
            $filePhoto->move('uploads/user', $fileName);

            if ($oldPhoto && file_exists(FCPATH . 'uploads/user/' . $oldPhoto)) {
                unlink(FCPATH . 'uploads/user/' . $oldPhoto);
            }
        }

        $updateData = [
            'full_name' => $fullName,
            'phone_number' => $phone,
        ];

        if ($fileName) {
            $updateData['photo'] = $fileName;
        }

        $this->adminModel->update($userId, $updateData);

        return redirect()->to(base_url('/bali/profile'))->with('message', 'Profile updated successfully');
    }

    public function updatePassword()
    {
        $userId = session()->get('userid');
        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmNewPassword = $this->request->getPost('confirm_new_password');

        // Ambil data pengguna berdasarkan user_id
        $userData = $this->adminModel->find($userId);

        // Validasi password lama
        if (!password_verify($currentPassword, $userData['password'])) {
            return redirect()->back()->with('error', 'Password lama tidak sesuai.');
        }

        // Validasi password baru tidak sama dengan password lama
        if ($currentPassword === $newPassword) {
            return redirect()->back()->with('error', 'Password baru tidak boleh sama dengan password lama.');
        }

        // Validasi password konfirmasi
        if ($newPassword !== $confirmNewPassword) {
            return redirect()->back()->with('error', 'Konfirmasi password baru tidak sesuai.');
        }

        // Hash password baru
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update password di database
        $this->adminModel->update($userId, ['password' => $newPasswordHash]);

        return redirect()->to(base_url('/bali/profile'))->with('message', 'Password berhasil diubah.');
    }
}
