<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\paketmodel;
use App\Models\DestinasiModel;

class Paket extends BaseController
{
    protected $paketModel;
    protected $destinasiModel;
    protected $roleLabel;

    public function __construct()
    {
        // Inisialisasi model PaketModel
        $this->paketModel = new paketmodel();
        $this->destinasiModel = new DestinasiModel();
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

        // Calculate the district (kabupaten) for each destination based on latitude and longitude
        foreach ($destinations as &$destination) {
            $destination['district'] = $this->getDistrictByLatLng($destination['latitude'], $destination['longitude']);
        }

        // Prepare data for view
        $data = [
            'title' => 'Detail Paket',
            'package' => $package,
            'destinations' => $destinations,
            'contact' => [
                'phone' => '628123456789', // Replace with actual contact phone
                'email' => 'contact@example.com' // Replace with actual contact email
            ]
        ];

        // Load views
        echo view('user/detail-paket', $data);
        echo view('user/Template/footer');
    }

    // Helper function to generate district (kabupaten) name from latitude and longitude
    public function getDistrictByLatLng($latitude, $longitude)
    {
        // URL API Nominatim untuk reverse geocoding
        $url = "https://nominatim.openstreetmap.org/reverse?lat={$latitude}&lon={$longitude}&format=json&addressdetails=1";

        // Inisialisasi cURL
        $ch = curl_init();

        // Set opsi cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Eksekusi permintaan cURL
        $response = curl_exec($ch);

        // Cek apakah ada kesalahan cURL
        if (curl_errno($ch)) {
            return "Error: " . curl_error($ch); // Tangani kesalahan
        }

        // Tutup cURL
        curl_close($ch);

        // Decode respons JSON
        $data = json_decode($response, true);

        // Cek apakah detail alamat tersedia
        if (isset($data['address']['suburb'])) {
            return $data['address']['suburb']; // Kembalikan suburb jika tersedia
        } elseif (isset($data['address']['town'])) {
            return $data['address']['town']; // Kembalikan town jika suburb tidak tersedia
        } elseif (isset($data['address']['city'])) {
            return $data['address']['city']; // Kembalikan city jika town tidak tersedia
        } else {
            return "Unknown District"; // Fallback jika tidak ada distrik yang ditemukan
        }
    }
}
