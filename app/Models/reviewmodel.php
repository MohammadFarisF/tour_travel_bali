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
        'review_id',
        'user_id',
        'package_id',
        'rating',
        'review_text',
        'review_date',
        'created_at',
        'updated_at'
    ];

    // Fungsi untuk mendapatkan semua data customer
    public function getReview($id = false)
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            reviews.*, 
            bookings.booking_id,
            users.user_id,
            users.full_name,
            packages.package_id,
            packages.package_name

        ');
        $builder->join('bookings', 'bookings.booking_id = reviews.booking_id', 'left');
        $builder->join('users', 'users.user_id = reviews.user_id', 'left');
        $builder->join('packages', 'packages.package_id = reviews.package_id', 'left');

        return $builder->get()->getResultArray();
    }

    // Fungsi untuk menghapus data customer
    public function deleteReview($id)
    {
        return $this->delete($id); // Menghapus berdasarkan ID
    }
}
