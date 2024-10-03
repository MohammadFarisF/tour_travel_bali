<?php

namespace App\Models;

use CodeIgniter\Model;

class BankPelangganModel extends Model
{
    protected $table = 'bank_customer';

    // Menetapkan primary key
    protected $primaryKey = 'custbank_id';

    // Fields that can be modified
    protected $allowedFields = [
        'custbank_id',
        'account_name',
        'account_number',
        'account_holder_name',
        'account_type',
        'created_at',
        'updated_at'
    ];

    public function getbankpelanggan($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->where(['custbank_id' => $id])->first();
    }

    public function hapus($id)
    {
        return $this->delete($id);
    }
}
