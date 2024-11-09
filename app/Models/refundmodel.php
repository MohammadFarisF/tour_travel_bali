<?php

namespace App\Models;

use CodeIgniter\Model;

class RefundModel extends Model
{
    protected $table = 'refunds';
    protected $primaryKey = 'refund_id';

    protected $allowedFields = [
        'customer_id', // ID dari tabel customer bank
        'booking_id',
        'payment_id',  // ID dari tabel bookings
        'refund_amount',
        'refund_date',
        'refund_status'
    ];

    // Fungsi untuk mendapatkan data refund beserta data terkait
    public function getRefunds()
    {
        return $this->select('refunds.*, payments.account_number, payments.account_holder_name, bookings.booking_id, bookings.total_amount, bookings.created_at, bookings.booking_status')
            ->join('customer', 'customer.customer_id = refunds.customer_id', 'left')
            ->join('bookings', 'bookings.booking_id = refunds.booking_id', 'left')
            ->join('payments', 'payments.payment_id = refunds.payment_id', 'left')
            ->get()
            ->getResultArray();
    }
}
