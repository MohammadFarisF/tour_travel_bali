<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    // Menentukan nama tabel
    protected $table = 'users';

    // Menentukan primary key tabel
    protected $primaryKey = 'user_id';

    // Field yang dapat dimodifikasi
    protected $allowedFields = [
        'user_id', 'full_name', 'email', 'phone_number', 'password', 'user_role', 'created_at', 'updated_at'
    ];

    // Fungsi untuk mendapatkan semua data customer
    public function getAdmin($id = null)
    {
        if ($id === null) {
            return $this->findAll(); // Mengambil semua data
        }

        return $this->where(['user_id' => $id])->first(); // Mengambil data berdasarkan ID
    }

    // Fungsi untuk menghapus data customer
    public function deleteUser($id)
    {
        return $this->delete($id); // Menghapus berdasarkan ID
    }
}
