<?php

namespace App\Models;

use CodeIgniter\Model;

class PaketModel extends Model
{
    protected $table = 'packages'; // Nama tabel

    // Menetapkan primary key
    protected $primaryKey = 'package_id';
    protected $useAutoIncrement = false;

    // Fields that can be modified
    protected $allowedFields = [
        'package_name', 'package_type', 'description',
        'created_at', 'updated_at'
    ];

    // Mendapatkan semua paket atau paket tertentu berdasarkan ID
    public function getPaket($id = false)
    {
        if ($id === false) {
            return $this->findAll(); // Mengambil semua data
        }

        return $this->where(['package_id' => $id])->first(); // Mengambil paket berdasarkan ID
    }

    // Menyimpan data paket (update)
    public function simpan($array)
    {
        return $this->update($array['package_id'], [
            'package_name' => $array['package_name'],
            'package_type' => $array['package_type'],
            'description' => $array['description'],
            'created_at' => $array['created_at'], // Jika perlu
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    // Menghapus paket berdasarkan ID
    public function hapus($id)
    {
        return $this->delete($id);
    }
}
