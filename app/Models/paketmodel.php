<?php

namespace App\Models;

use CodeIgniter\Model;

class paketmodel extends Model
{
    protected $table = 'packages';

    // Menetapkan primary key
    protected $primaryKey = 'package_id';
    protected $useAutoIncrement = false;

    // Fields that can be modified
    protected $allowedFields = [
        'package_id',
        'package_name',
        'package_type',
        'description',
        'created_at',
        'updated_at'
    ];

    public function getpaket($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->where(['package_id' => $id])->first();
    }

    public function hapus($id)
    {
        return $this->delete($id);
    }
}
