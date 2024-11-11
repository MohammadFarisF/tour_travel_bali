<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CustModel;

class Customer extends BaseController
{
    protected $CustomerModel;

    public function __construct()
    {
        // Inisialisasi model
        $this->CustomerModel = new CustModel();
    }

    // Method untuk menampilkan data customer
    public function index()
    {
        // Cek apakah user memiliki role admin
        $roleLabel = (session()->get('user_role') === 'owner') ? 'Super Admin' : 'Admin';
        if (session()->get('user_role') !== 'owner') {
            return redirect()->to(base_url('/bali'))->with('dilarang_masuk', 'Anda tidak memiliki akses untuk ke halaman ini.');
        }
        // Ambil data customer dari model
        $data = [
            'title' => 'Data Customer',
            'customer' => $this->CustomerModel->getCustomer(),
            'roleLabel' => $roleLabel,
        ];

        // Tampilkan tampilan template dengan data admin
        echo view('admin/Template/header', $data);   // Header dengan judul halaman
        echo view('admin/Template/sidebar', $data);       // Sidebar yang digunakan
        echo view('admin/customer', $data);             // Isi halaman admin dengan data admin yang diambil
        echo view('admin/Template/footer');          // Footer
    }

    public function showAccount()
    {
        // Ambil ID pengguna dari session
        $userId = session()->get('userid');  // Pastikan session ini sesuai dengan ID pengguna yang masuk

        // Ambil data pelanggan berdasarkan ID dari model
        $userData = $this->CustomerModel->where('customer_id', $userId)->first();

        // Pastikan data ditemukan
        if (!$userData) {
            return redirect()->to(base_url('profile/my_account'))->with('error', 'Data akun tidak ditemukan.');
        }

        // Data yang dikirimkan ke view
        $data = [
            'title' => 'My Account',
            'customer' => $userData
        ];

        echo view('user/Template/sidebar', $data);
        echo view('user/my_account', $data);  // Sesuaikan dengan file view Anda
    }

    // Method untuk memperbarui data akun
    public function updateAccount()
    {
        try {
            $userId = session()->get('userid');  // Ensure session ID is correct
            $newData = [
                'full_name' => $this->request->getPost('accountName'),
                'nik' => $this->request->getPost('accountNIK'),
                'gender' => $this->request->getPost('accountGender'),
                'tgl_lahir' => $this->request->getPost('accountBirthDate'),
                'email' => $this->request->getPost('accountEmail'),
                'phone_number' => $this->request->getPost('accountPhone[full]'),
                'citizen' => $this->request->getPost('accountCitizen'),
            ];

            // Check if a photo file is uploaded
            $photo = $this->request->getFile('accountPhoto');
            if ($photo && $photo->isValid()) {
                // Check if the user already has a photo
                $existingPhoto = $this->CustomerModel->where('customer_id', $userId)->first()['photo'];

                // If there is an existing photo, delete it from the upload directory
                if ($existingPhoto) {
                    $existingPhotoPath = FCPATH . 'public/uploads/customer/' . $existingPhoto;
                    if (file_exists($existingPhotoPath)) {
                        unlink($existingPhotoPath);  // Delete the old photo
                    }
                }

                // Generate a random name for the new photo
                $photoName = $photo->getRandomName();

                // Move the uploaded photo to the upload directory
                $photo->move(FCPATH . 'public/uploads/customer', $photoName);

                // Update the photo field in the data array
                $newData['photo'] = $photoName;
            }

            // Update the data in the database
            $updateResult = $this->CustomerModel->update($userId, $newData);

            // Check if the update was successful
            if ($updateResult === false) {
                throw new \RuntimeException('Gagal memperbarui data akun.');
            }

            // Redirect back to the account page with a success message
            return redirect()->to(base_url('profile/my_account'))->with('status', 'Data akun berhasil diperbarui.');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            // Check if the exception is related to the NIK uniqueness constraint
            if (strpos($e->getMessage(), 'NIK') !== false) {
                return redirect()->to(base_url('profile/my_account'))->with('error', 'NIK sudah terdaftar. Silakan gunakan NIK yang berbeda.');
            }

            // Log the exception error for debugging purposes
            log_message('error', 'Database Error: ' . $e->getMessage());

            // Generic error message for other database exceptions
            return redirect()->to(base_url('profile/my_account'))->with('error', 'Terjadi kesalahan, coba lagi.');
        } catch (\Exception $e) {
            // Catch all other exceptions
            log_message('error', 'Unexpected Error: ' . $e->getMessage());
            return redirect()->to(base_url('profile/my_account'))->with('error', 'Terjadi kesalahan, coba lagi.');
        }
    }
}
