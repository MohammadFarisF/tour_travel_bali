<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'payment_id';

    protected $allowedFields = [
        'booking_id',
        'payment_method',
        'payment_status',
        'proof_of_payment',
        'account_name',
        'account_number',
        'account_holder_name',
    ];

    public function getPayments()
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            payments.*, 
            bookings.booking_id,
            bookings.customer_id,
            bookings.total_amount,
            bookings.booking_status
        ');
        $builder->join('bookings', 'bookings.booking_id = payments.booking_id', 'left');
        $builder->join('customer', 'customer.customer_id = payments.customer_id', 'left');

        return $builder->get()->getResultArray();
    }

    public function getPayment($userId = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('
        payments.*, 
        bookings.booking_id,
        bookings.customer_id,
        bookings.total_amount,
        bookings.booking_status
    ');
        $builder->join('bookings', 'bookings.booking_id = payments.booking_id', 'left');
        $builder->join('customer', 'customer.customer_id = payments.customer_id', 'left');

        // Filter data berdasarkan user_id yang login
        if ($userId !== null) {
            $builder->where('bookings.customer_id', $userId);
        }

        return $builder->get()->getResultArray();
    }

    public function getBank()
    {
        $builder = $this->db->table($this->table);
        $builder->select('
        payments.account_name,
        payments.account_number,
        payments.account_holder_name,
        customer.full_name
    ');
        $builder->join('customer', 'customer.customer_id = payments.customer_id', 'left');
        return $builder->get()->getResultArray();
    }
}
