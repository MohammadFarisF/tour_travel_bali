<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'booking_id';

    protected $allowedFields = [
        'booking_id',
        'customer_id',
        'package_id',
        'address',
        'total_people',
        'departure_date',
        'return_date',
        'total_amount',
        'cust_request',
        'booking_status',
        'payment_status',
        'created_at',
        'updated_at'
    ];

    // Mengambil data untuk dashboard dengan join ke tabel terkait
    public function getBooking()
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            bookings.*, 
            customer.full_name AS user_name, 
            packages.package_name AS package_name, 
            GROUP_CONCAT(destinations.destination_name ORDER BY destinations.destination_name SEPARATOR ", ") AS destination_names,  
            MAX(vehicles.vehicle_name) AS vehicle_name
        ');

        // Join ke tabel users
        $builder->join('customer', 'customer.customer_id = bookings.customer_id', 'left');

        // Join ke tabel packages
        $builder->join('packages', 'packages.package_id = bookings.package_id', 'left');

        // Join ke tabel booking_destinations dan destinations
        $builder->join('booking_destinations', 'booking_destinations.booking_id = bookings.booking_id', 'left');
        $builder->join('destinations', 'destinations.destination_id = booking_destinations.destination_id', 'left');

        // Join ke tabel booking_vehicles dan vehicles
        $builder->join('booking_vehicles', 'booking_vehicles.booking_id = bookings.booking_id', 'left');
        $builder->join('vehicles', 'vehicles.vehicle_id = booking_vehicles.vehicle_id', 'left');

        // Grouping hanya berdasarkan booking_id, tetapi tetap menggabungkan destinasi
        $builder->groupBy('bookings.booking_id');

        // Return semua hasil
        return $builder->get()->getResultArray();
    }
    // Mengambil semua data bookings termasuk destinasi, kendaraan, dan status refund
    public function getAllBookings()
    {
        return $this->select('bookings.*, 
                             GROUP_CONCAT(destinations.destination_name) as destination_names, 
                             MAX(vehicles.vehicle_name) as vehicle_name, 
                             COALESCE(MAX(refunds.refund_status), "-") as refund_status,
                             customer.full_name AS user_name,
                             packages.package_name')
            ->join('packages', 'packages.package_id = bookings.package_id', 'left')
            ->join('customer', 'customer.customer_id = bookings.customer_id', 'left')
            ->join('booking_destinations', 'booking_destinations.booking_id = bookings.booking_id', 'left')
            ->join('destinations', 'destinations.destination_id = booking_destinations.destination_id', 'left')
            ->join('booking_vehicles', 'booking_vehicles.booking_id = bookings.booking_id', 'left')
            ->join('vehicles', 'vehicles.vehicle_id = booking_vehicles.vehicle_id', 'left')
            ->join('refunds', 'refunds.booking_id = bookings.booking_id', 'left')
            ->groupBy('bookings.booking_id')
            ->findAll();
    }

    // Mengambil data bookings berdasarkan filter tanggal
    public function getFilteredBookings($dateType, $dateRange, $status = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('bookings.*, 
                      GROUP_CONCAT(destinations.destination_name) as destination_names, 
                      MAX(vehicles.vehicle_name) as vehicle_name, 
                      COALESCE(MAX(refunds.refund_status), "-") as refund_status,
                      customer.full_name AS user_name,
                      packages.package_name');
        $builder->join('customer', 'customer.customer_id = bookings.customer_id', 'left');
        $builder->join('packages', 'packages.package_id = bookings.package_id', 'left');
        $builder->join('booking_destinations', 'booking_destinations.booking_id = bookings.booking_id', 'left');
        $builder->join('destinations', 'destinations.destination_id = booking_destinations.destination_id', 'left');
        $builder->join('booking_vehicles', 'booking_vehicles.booking_id = bookings.booking_id', 'left');
        $builder->join('vehicles', 'vehicles.vehicle_id = booking_vehicles.vehicle_id', 'left');
        $builder->join('refunds', 'refunds.booking_id = bookings.booking_id', 'left');
        $builder->groupBy('bookings.booking_id');

        // Filter berdasarkan jenis tanggal
        if ($dateType && $dateRange) {
            if ($dateType === 'daily') {
                $builder->where('DATE(bookings.created_at)', $dateRange);
            } elseif ($dateType === 'monthly') {
                // Ubah format input 'YYYY-MM' menjadi rentang tanggal awal dan akhir bulan
                if (strpos($dateRange, ' to ') === false) {
                    $startDate = date('Y-m-01', strtotime($dateRange)); // Tanggal awal bulan
                    $endDate = date('Y-m-t', strtotime($dateRange)); // Tanggal akhir bulan
                } else {
                    list($startDate, $endDate) = explode(' to ', $dateRange); // Jika menggunakan rentang
                }
                $builder->where('bookings.created_at >=', $startDate);
                $builder->where('bookings.created_at <=', $endDate);
            } elseif ($dateType === 'yearly') {
                $builder->where('YEAR(bookings.created_at)', $dateRange);
            }
        }

        // Filter berdasarkan status
        if ($status && $status !== 'all') {
            $builder->where('bookings.booking_status', $status);
        }

        return $builder->get()->getResultArray();
    }


    public function getBookingByUserId($userId)
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            bookings.*, 
            customer.full_name AS user_name, 
            packages.package_name AS package_name, 
            GROUP_CONCAT(destinations.destination_name ORDER BY destinations.destination_name SEPARATOR ", ") AS destination_names,  
            MAX(vehicles.vehicle_name) AS vehicle_name
        ');

        // Join ke tabel terkait
        $builder->join('customer', 'customer.customer_id = bookings.customer_id', 'left');
        $builder->join('packages', 'packages.package_id = bookings.package_id', 'left');
        $builder->join('booking_destinations', 'booking_destinations.booking_id = bookings.booking_id', 'left');
        $builder->join('destinations', 'destinations.destination_id = booking_destinations.destination_id', 'left');
        $builder->join('booking_vehicles', 'booking_vehicles.booking_id = bookings.booking_id', 'left');
        $builder->join('vehicles', 'vehicles.vehicle_id = booking_vehicles.vehicle_id', 'left');

        // Filter berdasarkan user_id
        $builder->where('bookings.customer_id', $userId);
        $builder->groupBy('bookings.booking_id');

        return $builder->get()->getResultArray();
    }
    public function getInvoiceBookingsByUserId($userId)
    {
        $builder = $this->db->table($this->table);
        $builder->select('
        bookings.*, 
        customer.full_name AS user_name, 
        packages.package_name AS package_name, 
        GROUP_CONCAT(destinations.destination_name ORDER BY destinations.destination_name SEPARATOR ", ") AS destination_names,  
        MAX(vehicles.vehicle_name) AS vehicle_name
    ');

        // Join ke tabel terkait
        $builder->join('customer', 'customer.customer_id = bookings.customer_id', 'left');
        $builder->join('packages', 'packages.package_id = bookings.package_id', 'left');
        $builder->join('booking_destinations', 'booking_destinations.booking_id = bookings.booking_id', 'left');
        $builder->join('destinations', 'destinations.destination_id = booking_destinations.destination_id', 'left');
        $builder->join('booking_vehicles', 'booking_vehicles.booking_id = bookings.booking_id', 'left');
        $builder->join('vehicles', 'vehicles.vehicle_id = booking_vehicles.vehicle_id', 'left');

        // Filter berdasarkan user_id dan status tertentu
        $builder->where('bookings.customer_id', $userId);
        $builder->whereIn('bookings.booking_status', ['confirmed', 'completed']);
        $builder->groupBy('bookings.booking_id');

        return $builder->get()->getResultArray();
    }
}
