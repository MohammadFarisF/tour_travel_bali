<?php

namespace App\Models;

use CodeIgniter\Model;

class bookvehiclemodel extends Model
{
    protected $table = 'booking_vehicles';
    protected $primaryKey = 'booking_vehicle_id'; // Pastikan sesuai dengan primary key tabel Anda
    protected $allowedFields = [
        'booking_id',
        'vehicle_id'
    ];

    public function allocateVehicles($bookingId)
    {
        try {
            $result = $this->db->query("CALL allocateVehicles('$bookingId')");
            log_message('debug', 'allocateVehicles query result: ' . json_encode($result));
        } catch (\Exception $e) {
            log_message('error', 'Error in allocateVehicles: ' . $e->getMessage());
        }
    }
    
}
