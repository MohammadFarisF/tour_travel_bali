<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\paketmodel;
use App\Models\DestinasiModel;
use App\Models\CustModel;
use App\Models\kendaraanmodel;

class Paket extends BaseController
{
    protected $paketModel;
    protected $destinasiModel;
    protected $roleLabel;
    protected $customerModel;
    protected $kendaraanModel;

    public function __construct()
    {
        // Inisialisasi model PaketModel
        $this->paketModel = new paketmodel();
        $this->destinasiModel = new DestinasiModel();
        $this->customerModel = new CustModel();
        $this->kendaraanModel = new kendaraanmodel();
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

        $packageType = $this->request->getPost('package_type');
        $dayCount = ($packageType === 'multiple_day') ? $this->request->getPost('day_count') : 1;

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
            'hari' => $dayCount,
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

        // Retrieve the package type and day count from the form
        $packageType = $this->request->getPost('package_type');
        $dayCount = ($packageType === 'multiple_day') ? $this->request->getPost('day_count') : 1;

        // Prepare the data to be updated
        $data = [
            'package_name' => $this->request->getPost('package_name'),
            'package_type' => $packageType,
            'description' => $this->request->getPost('description'),
            'hari' => $dayCount, // Set day count based on the package type
            'created_at' => $this->request->getPost('created_at'), // Bisa disesuaikan
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Process the photo upload if a new one is provided
        $filePhoto = $this->request->getFile('foto');

        if ($filePhoto && $filePhoto->isValid() && !$filePhoto->hasMoved()) {
            // Delete the old photo if exists
            if (!empty($package['foto'])) {
                $oldFilePath = 'uploads/paket/' . $package['foto'];
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); // Delete the old file
                }
            }

            // Upload the new photo
            $fileName = $filePhoto->getRandomName(); // Generate a random file name
            $filePhoto->move('uploads/paket', $fileName); // Move the uploaded file to the folder
            $data['foto'] = $fileName; // Add the new photo name to the data
        } else {
            // If no new file, retain the old photo
            $data['foto'] = $package['foto'];
        }

        // Update the package data in the database
        $this->paketModel->update($id, $data);

        // Redirect to the package list page after update
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
    public function packageDetails($packageId)
    {
        // Retrieve package details
        $package = $this->paketModel->find($packageId);

        // If package not found, show error
        if (empty($package)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Paket tidak ditemukan');
        }

        // Get destinations related to the package ID
        $destinations = $this->destinasiModel->where('package_id', $packageId)->findAll();

        $customerId = session()->get('userid');
        $customer = $this->customerModel->find($customerId);

        $availableVehicles = $this->kendaraanModel->where('status', 'available')->findAll();

        // Check if customer data is complete
        $isDataComplete = !empty($customer['full_name']) &&
            !empty($customer['email']) &&
            !empty($customer['phone_number']) &&
            !empty($customer['nik']) &&
            !empty($customer['citizen']) &&
            !empty($customer['gender']);
        // Prepare data for view
        $data = [
            'title' => 'Detail Paket - ',
            'package' => $package,
            'destinations' => $destinations,
            'customer' => $customer,
            'isDataComplete' => $isDataComplete,
            'availableVehicles' => !empty($availableVehicles),
            'contact' => [
                'phone' => '6282236906042', // Replace with actual contact phone
                'email' => 'explorebali52@gmail.com' // Replace with actual contact email
            ]
        ];

        echo view('user/Template/header', $data);
        echo view('user/detail-paket', $data);
        echo view('user/Template/footer');
    }
}
