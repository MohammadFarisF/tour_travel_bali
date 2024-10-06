<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    // Menentukan nama tabel
    protected $table = 'reviews';

    // Menentukan primary key tabel
    protected $primaryKey = 'review_id';

    protected $foreignKey = ['user_id', 'package_id'];


    // Field yang dapat dimodifikasi
    protected $allowedFields = [
        'review_id', 'user_id', 'package_id', 'rating', 'review_text', 'review_date', 'created_at', 'updated_at'
    ];

    // Fungsi untuk mendapatkan semua data customer
    public function getReview($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->where(['review_id' => $id])->first();
    }

    // Fungsi untuk menghapus data customer
    public function deleteReview($id)
    {
        return $this->delete($id); // Menghapus berdasarkan ID
    }
}
