<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\kendaraanmodel;

class Kendaraan extends BaseController
{
    protected $kendaraanModel;

    public function __construct()
    {
        $this->kendaraanModel = new kendaraanmodel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kendaraan',
            'kendaraan' => $this->kendaraanModel->getkendaraan(),
        ];

        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar');
        echo view('admin/kendaraan', $data); // Make sure this view displays the vehicle list
        echo view('admin/Template/footer');
    }

    public function detail($id)
    {
        $data['kendaraan'] = $this->kendaraanModel->getkendaraan($id);
        if (empty($data['kendaraan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kendaraan tidak ditemukan');
        }

        $data['title'] = 'Detail Kendaraan';
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar');
        echo view('admin/kendaraan_detail', $data); // Create this view for detail display
        echo view('admin/Template/footer');
    }

    public function create()
    {
        $data['title'] = 'Tambah Kendaraan';
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar');
        echo view('admin/kendaraan_create'); // Create this view for adding new vehicle
        echo view('admin/Template/footer');
    }

    public function store()
    {
        $this->kendaraanModel->save([
            'vehicle_name' => $this->request->getPost('vehicle_name'),
            'license_plate' => $this->request->getPost('license_plate'),
            'capacity' => $this->request->getPost('capacity'),
            'vehicle_type' => $this->request->getPost('vehicle_type'),
            'vehicle_photo' => $this->request->getPost('vehicle_photo'),
            'status' => $this->request->getPost('status'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/dashboard/kendaraan'); // Adjust to your route
    }

    public function edit($id)
    {
        $data['kendaraan'] = $this->kendaraanModel->getkendaraan($id);
        if (empty($data['kendaraan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kendaraan tidak ditemukan');
        }

        $data['title'] = 'Edit Kendaraan';
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar');
        echo view('admin/kendaraan_edit', $data); // Create this view for editing
        echo view('admin/Template/footer');
    }

    public function update()
    {
        $id = $this->request->getPost('vehicle_id');

        $this->kendaraanModel->simpan([
            'vehicle_id' => $id,
            'vehicle_name' => $this->request->getPost('vehicle_name'),
            'license_plate' => $this->request->getPost('license_plate'),
            'capacity' => $this->request->getPost('capacity'),
            'vehicle_type' => $this->request->getPost('vehicle_type'),
            'vehicle_photo' => $this->request->getPost('vehicle_photo'),
            'status' => $this->request->getPost('status'),
            'created_at' => $this->request->getPost('created_at'), // Adjust if not needed
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/dashboard/kendaraan'); // Adjust to your route
    }

    public function delete($id)
    {
        $this->kendaraanModel->hapus($id);
        return redirect()->to('/dashboard/kendaraan'); // Adjust to your route
    }
}
