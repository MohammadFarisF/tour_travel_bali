<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'payment_id';

    protected $allowedFields = [
        'booking_id',
        'customer_id',
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
            bookings.total_amount,
            bookings.booking_status,
            customer.customer_id,
            customer.full_name
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
        bookings.total_amount,
        bookings.booking_status
        customer.customer_id,
        customer.full_name
        ');
        $builder->join('bookings', 'bookings.booking_id = payments.booking_id', 'left');
        $builder->join('customer', 'customer.customer_id = payments.customer_id', 'left');

        // Filter data berdasarkan user_id yang login
        if ($userId !== null) {
            $builder->where('customer.customer_id', $userId);
        }

        return $builder->get()->getResultArray();
    }
}
