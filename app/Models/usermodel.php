<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
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
    public function getUser($id = null)
    {
        if ($id === null) {
            // Hanya ambil pengguna dengan role admin
            return $this->where('user_role', 'customer')->findAll();
        } else {
            // Ambil data admin berdasarkan ID, jika diberikan
            return $this->where(['user_role' => 'customer', 'user_id' => $id])->first();
        }
    }

    // Fungsi untuk menghapus data customer
    public function deleteUser($id)
    {
        return $this->delete($id); // Menghapus berdasarkan ID
    }
}
