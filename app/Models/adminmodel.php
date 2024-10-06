<?php

namespace App\Models;

use CodeIgniter\Model;

class adminmodel extends Model
{
    protected $table = 'users';

    // Menetapkan primary key
    protected $primaryKey = 'user_id';
    protected $useAutoIncrement = false;

    // Fields that can be modified

    
    protected $allowedFields = [
        'user_id',
        'full_name',
        'email',
        'password',
        'phone_number',
        'user_role',
        'status',
        'created_at',
        'updated_at'
    ];

        // Method untuk mengambil data admin saja
        public function getAdmin($id = null)
        {
            if ($id === null) {
                // Hanya ambil pengguna dengan role admin
                return $this->where('user_role', 'admin')->findAll();
            } else {
                // Ambil data admin berdasarkan ID, jika diberikan
                return $this->where(['user_role' => 'admin', 'user_id' => $id])->first();
            }
        }
    
    
    
    public function hapus($id)
    {
        return $this->delete($id);
    }
}
