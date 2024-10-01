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
        'vehicle_id',
        'vehicle_name',
        'license_plate',
        'capacity',
        'vehicle_type',
        'vehicle_photo',
        'status',
        'created_at',
        'updated_at'
    ];

    public function getkendaraan($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->where(['vehicle_id' => $id])->first();
    }

    public function hapus($id)
    {
        return $this->delete($id);
    }
}
