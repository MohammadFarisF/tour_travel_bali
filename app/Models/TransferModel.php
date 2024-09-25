<?php

namespace App\Models;

use CodeIgniter\Model;

class TransferModel extends Model
{
    protected $table = 'transfer';
    protected $primaryKey = 'id_transfer';
    protected $allowedFields = ['id_transfer', 'id_pemain', 'klub_sebelum', 'status', 'harga_transfer'];

    public function player()
    {
        return $this->belongsTo('App\Models\PlayersModel', 'id_pemain');
    }
}
