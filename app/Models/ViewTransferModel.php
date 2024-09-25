<?php

namespace App\Models;

use CodeIgniter\Model;

class ViewTransferModel extends Model
{
    protected $table = 'transfer_view';
    protected $primaryKey = 'id_transfer';
    protected $allowedFields = ['id_transfer', 'id_pemain', 'nopung', 'nama', 'posisi', 'klub_sebelum', 'bergabung', 'harga_transfer', 'harga_pasar'];
}
