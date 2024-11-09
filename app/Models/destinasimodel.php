<?php

namespace App\Models;

use CodeIgniter\Model;

class DestinasiModel extends Model
{
    protected $table = 'destinations';

    // Menetapkan primary key
    protected $primaryKey = 'destination_id';
    protected $useAutoIncrement = false; // Atur ke true jika auto-increment

    // Fields that can be modified
    protected $allowedFields = [
        'package_id',
        'destination_name',
        'latitude',
        'longitude',
        'description',
        'foto',
        'harga_per_orang',
        'created_at',
        'updated_at'
    ];

    // Menggunakan timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Fungsi untuk mengambil data destinasi beserta nama paketnya
    public function getdestinasi($id = false)
    {
        $this->select('destinations.*, packages.package_name, packages.package_id');
        $this->join('packages', 'packages.package_id = destinations.package_id'); // Join dengan tabel packages

        if ($id === false) {
            return $this->findAll();
        }

        return $this->where(['destination_id' => $id])->first();
    }

    // Fungsi hapus
    public function hapus($id)
    {
        return $this->delete($id);
    }

    public function getPricesByPackageId($packageId)
    {
        return $this->where('package_id', $packageId)->findAll();
    }
}
