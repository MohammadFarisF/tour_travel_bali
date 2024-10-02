<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\adminmodel;

class Admin extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new adminmodel();
    }

    public function index()
    {
        $data = [
            'title' => 'Admin',
            'kendaraan' => $this->adminModel->getAdmin(),
        ];

        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar');
        echo view('admin/admin', $data); // Make sure this view displays the vehicle list
        echo view('admin/Template/footer');
    }

    public function create()
    {
        $data['title'] = 'Tambah Admin';
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar');
        echo view('admin/admin_create'); // Create this view for adding new vehicle
        echo view('admin/Template/footer');
    }

    public function store()
    {
        // Simpan data ke database
        $this->adminModel->save([
            'vehicle_name' => $this->request->getPost('vehicle_name'),
            'license_plate' => $this->request->getPost('license_plate'),
            'capacity' => $this->request->getPost('capacity'),
            'vehicle_type' => $this->request->getPost('vehicle_type'),
            'vehicle_photo' => $fileName, // Simpan nama file di database
            'status' => 'available',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/dashboard/admin');
    }


    public function edit($id)
    {
        $data['admin'] = $this->adminModel->getAdmin($id);
        if (empty($data['admin'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('admin tidak ditemukan');
        }

        $data['title'] = 'Edit Admin';
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar');
        echo view('admin/Admin_edit', $data); // Create this view for editing
        echo view('admin/Template/footer');
    }

    public function update($id)
    {
        // Ambil data kendaraan yang ada berdasarkan ID
        $kendaraan = $this->adminModel->find($id);
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

        // Update data ke database
        $this->adminModel->update($id, $data);

        return redirect()->to('/dashboard/kendaraan'); // Redirect setelah sukses
    }

    public function delete($id)
    {
        // Mencari data customer berdasarkan ID
        $customer = $this->adminModel->find($id);

        if ($customer) {
            // Jika data customer ditemukan, hapus
            $this->adminModel->deleteCustomer($id);
            // Redirect dengan pesan sukses
            return redirect()->to('dashboard/admin')->with('message', 'Data customer berhasil dihapus.');
        }

        // Jika data tidak ditemukan, beri pesan error
        return redirect()->to('dashboard/admin')->with('error', 'Data customer tidak ditemukan.');
    }
}
