<?php

namespace App\Models;

use CodeIgniter\Model;

class bookdestinasimodel extends Model
{
    protected $table = 'booking_destinations';
    protected $primaryKey = 'booking_destination_id'; // Pastikan sesuai dengan primary key tabel Anda
    protected $allowedFields = [
        'booking_id',
        'destination_id'
    ];
}
