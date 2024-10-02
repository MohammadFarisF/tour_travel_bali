<?php

namespace App\Models;

use CodeIgniter\Model;

class DestinasiModel extends Model
{
    protected $table = 'destinations';

    // Menetapkan primary key
    protected $primaryKey = 'destination_id';
    protected $useAutoIncrement = false;

    // Fields that can be modified
    protected $allowedFields = [
        'destination_id',
        'destination_name',
        'location',
        'description',
        'created_at',
        'updated_at'
    ];

    public function getdestinasi($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->where(['destination_id' => $id])->first();
    }

    public function hapus($id)
    {
        return $this->delete($id);
    }
}
