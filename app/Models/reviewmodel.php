<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    // Menentukan nama tabel
    protected $table = 'reviews';

    // Menentukan primary key tabel
    protected $primaryKey = 'review_id';

    protected $foreignKey = ['booking_id'];
    // Field yang dapat dimodifikasi
    protected $allowedFields = [
        'review_id',
        'booking_id',
        'rating',
        'review_text',
        'review_photo',
        'review_date'
    ];

    // Fungsi untuk mendapatkan data review berdasarkan user_id
    public function getReview($userId = false)
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            reviews.*, 
            bookings.booking_id,
            bookings.customer_id,
            bookings.package_id,
            customer.full_name,
            packages.package_name
        ');
        $builder->join('bookings', 'bookings.booking_id = reviews.booking_id', 'left');
        $builder->join('packages', 'packages.package_id = bookings.package_id', 'left');
        $builder->join('customer', 'customer.customer_id = bookings.customer_id', 'left');

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

    public function getReviewCust($userId = false)
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            reviews.*, 
            bookings.*,
            customer.full_name,
            packages.package_name
        ');
        $builder->join('bookings', 'bookings.booking_id = reviews.booking_id', 'left');
        $builder->join('packages', 'packages.package_id = bookings.package_id', 'left');
        $builder->join('customer', 'customer.customer_id = bookings.customer_id', 'left');

        // Filter based on user_id if provided
        if ($userId) {
            $builder->where('bookings.customer_id', $userId);
        }
        $builder->where('bookings.booking_status', 'completed');


        return $builder->get()->getResultArray();
    }

    public function getReviewsByPackageId($packageId)
    {
        $builder = $this->db->table($this->table);
        $builder->select('reviews.*, bookings.*');
        $builder->join('bookings', 'bookings.booking_id = reviews.booking_id', 'left');
        $builder->where('bookings.package_id', $packageId); // Filter by package_id
        return $builder->get()->getResultArray();
    }

    public function getReviewsWithPackageAndBooking()
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            reviews.*, 
            bookings.*,
            customer.full_name,
            customer.citizen,
            packages.package_name
        ');
        $builder->join('bookings', 'bookings.booking_id = reviews.booking_id', 'left');
        $builder->join('packages', 'packages.package_id = bookings.package_id', 'left');
        $builder->join('customer', 'customer.customer_id = bookings.customer_id', 'left');

        $builder->where('bookings.booking_status', 'completed');


        return $builder->get()->getResultArray();
    }
}
