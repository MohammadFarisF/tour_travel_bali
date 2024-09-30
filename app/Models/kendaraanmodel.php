<?php

namespace App\Models;

use CodeIgniter\Model;

class kendaraanmodel extends Model
{
    protected $table = 'vehicles';
    
    // Menetapkan primary key
    protected $primaryKey = 'vehicle_id';

    // Fields that can be modified
    protected $allowedFields = [
        'vehicle_id', 'vehicle_name', 'license_plate',
        'capacity', 'vehicle_type', 'vehicle_photo',
        'status', 'created_at', 'updated_at'
    ];

    public function getkendaraan($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->where(['vehicle_id' => $id])->first();
    }

    public function simpan($array)
    {
        return $this->update($array['vehicle_id'], [
            'vehicle_name' => $array['vehicle_name'],
            'license_plate' => $array['license_plate'],
            'capacity' => $array['capacity'],
            'vehicle_type' => $array['vehicle_type'],
            'vehicle_photo' => $array['vehicle_photo'],
            'status' => $array['status'],
            'created_at' => $array['created_at'],
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function hapus($id)
    {
        return $this->delete($id);
    }
}
