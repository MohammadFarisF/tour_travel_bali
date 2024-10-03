<?php

namespace App\Models;

use CodeIgniter\Model;

class BankTravelModel extends Model
{
    protected $table = 'bank_travel';

    // Menetapkan primary key
    protected $primaryKey = 'trabank_id';

    // Fields that can be modified
    protected $allowedFields = [
        'trabank_id',
        'account_number',
        'account_holder_name',
        'bank_name',
        'photo',
        'created_at',
        'updated_at'
    ];

    public function getbanktravel($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->where(['trabank_id' => $id])->first();
    }

    public function hapus($id)
    {
        return $this->delete($id);
    }
}
