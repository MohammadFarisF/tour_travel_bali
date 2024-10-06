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
    ];

    public function getPayments()
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            payments.*, 
            bookings.booking_id,
            users.full_name AS user_name,
            bookings.total_amount,
            bookings.booking_status
        ');
        $builder->join('bookings', 'bookings.booking_id = payments.booking_id', 'left');
        $builder->join('users', 'users.user_id = bookings.user_id', 'left');

        return $builder->get()->getResultArray();
    }
}
