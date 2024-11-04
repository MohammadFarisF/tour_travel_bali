<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    // Menentukan nama tabel
    protected $table = 'reviews';

    // Menentukan primary key tabel
    protected $primaryKey = 'review_id';

    protected $foreignKey = ['customer_id', 'package_id'];
    // Field yang dapat dimodifikasi
    protected $allowedFields = [
        'review_id',
        'customer_id',
        'package_id',
        'rating',
        'review_text',
        'review_photo',
        'review_date',
        'created_at',
        'updated_at'
    ];

    // Fungsi untuk mendapatkan data review berdasarkan user_id
    public function getReview($userId = false)
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            reviews.*, 
            bookings.booking_id,
            customer.customer_id,
            customer.full_name,
            packages.package_id,
            packages.package_name
        ');
        $builder->join('bookings', 'bookings.booking_id = reviews.booking_id', 'left');
        $builder->join('customer', 'customer.customer_id = reviews.customer_id', 'left');
        $builder->join('packages', 'packages.package_id = reviews.package_id', 'left');

        // Filter based on user_id if provided
        if ($userId) {
            $builder->where('reviews.user_id', $userId);
        }

        return $builder->get()->getResultArray();
    }

    // Fungsi untuk menghapus data customer
    public function deleteReview($id)
    {
        return $this->delete($id); // Menghapus berdasarkan ID
    }
}
