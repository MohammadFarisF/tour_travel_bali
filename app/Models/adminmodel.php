<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    // Menentukan nama tabel
    protected $table = 'admin';

    // Menentukan primary key tabel
    protected $primaryKey = 'user_id';
    protected $useAutoIncrement = false;

    // Field yang dapat dimodifikasi
    protected $allowedFields = [
        'user_id',
        'full_name',
        'email',
        'phone_number',
        'password',
        'user_role',
        'photo',
        'created_at',
        'updated_at'
    ];


    public function getAdmin($id = null)
    {
        if ($id === null) {
            // Ambil semua pengguna dengan role admin atau owner
            return $this->whereIn('user_role', ['admin', 'owner'])->findAll();
        } else {
            // Ambil data admin atau owner berdasarkan ID, jika diberikan
            return $this->whereIn('user_role', ['admin', 'owner'])->where('user_id', $id)->first();
        }
    }
}
