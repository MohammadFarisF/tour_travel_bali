<?php

namespace App\Models;

use CodeIgniter\Model;

class RefundModel extends Model
{
    protected $table = 'refunds';
    protected $primaryKey = 'refund_id';

    protected $allowedFields = [
        'booking_id',
        'refund_amount',
        'refund_date',
        'refund_status'
    ];

    // Fungsi untuk mendapatkan data refund beserta data terkait
    public function getRefunds()
    {
        return $this->select('refunds.*, bookings.booking_id, bookings.customer_id, bookings.total_amount, bookings.created_at, bookings.booking_status, 
            payments.account_number, payments.account_holder_name, 
            customer.customer_id, customer.full_name, customer.email')
            ->join('bookings', 'bookings.booking_id = refunds.booking_id', 'left') // Relasi ke tabel bookings
            ->join('payments', 'payments.booking_id = bookings.booking_id', 'left') // Relasi melalui booking_id
            ->join('customer', 'customer.customer_id = bookings.customer_id', 'left') // Relasi melalui customer_id di bookings
            ->get()
            ->getResultArray();
    }
    public function processRefund($bookingId)
    {
        // Memanggil stored procedure
        $query = $this->db->query("CALL calculateRefund('$bookingId')");

        // Mengambil hasil
        return $query->getRow();
    }
}
