<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Exceptions\DatabaseException;

class CustModel extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'customer_id';
    protected $useAutoIncrement = false;
    protected $allowedFields = [
        'customer_id',
        'nik',
        'email',
        'password',
        'full_name',
        'phone_number',
        'photo',
        'citizen',
        'tgl_lahir',
        'gender',
        'user_role',
        'created_at',
        'updated_at'
    ];

    public function insertCustomer($data)
    {
        try {
            // Insert data
            return $this->insert($data);
        } catch (DatabaseException $e) {
            // Tangani error jika terjadi, seperti NIK duplikat
            return $e->getMessage(); // Bisa Anda modifikasi sesuai kebutuhan
        }
    }

    public function getCustomer()
    {
        return $this->findAll();
    }

    public function hapus($id)
    {
        return $this->delete($id);
    }
}
