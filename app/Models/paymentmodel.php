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
            bookings.total_amount,
            bookings.booking_status,
            bank_customer.custbank_id,
            bank_customer.account_number,
            bank_customer.account_holder_name,

        ');
        $builder->join('bookings', 'bookings.booking_id = payments.booking_id', 'left');
        $builder->join('bank_customer', 'bank_customer.custbank_id = payments.custbank_id', 'left');

        return $builder->get()->getResultArray();
    }
}
