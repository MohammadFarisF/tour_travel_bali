<?php

namespace App\Models;

use CodeIgniter\Model;

class CustModel extends Model
{
    // Menentukan nama tabel
    protected $table = 'customer';

    // Menentukan primary key tabel
    protected $primaryKey = 'customer_id';
    protected $useAutoIncrement = false;

    // Field yang dapat dimodifikasi
    protected $allowedFields = [
        'customer_id',
        'email',
        'password',
        'full_name',
        'phone_number',
        'photo',
        'citizen',
        'tgl_lahir',
        'gender',
        'account_name',
        'account_number',
        'account_holder_name',
        'user_role',
        'created_at',
        'updated_at'
    ];


    public function getBank()
    {
        return $this->select('full_name, account_name, account_number, account_holder_name')->findAll();
    }


    // Mendapatkan data profil terbatas
    public function getProfile($id)
    {
        return $this->select('full_name, email, photo, gender, phone_number, tgl_lahir, citizen, user_role')
            ->where('customer_id', $id)
            ->first();
    }

    // Mendapatkan data bank
    public function getCustomer()
    {
        return $this->findAll();
    }

    public function hapus($id)
    {
        return $this->delete($id);
    }
}
