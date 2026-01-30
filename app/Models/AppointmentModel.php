<?php

namespace App\Models;

use CodeIgniter\Model;

class AppointmentModel extends Model
{
    protected $table = 'appointments';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'customer_name',
        'phone',
        'email',
        'barber_id',
        'date',
        'start_time',
        'end_time',
        'status',
        'total_price'
    ];

    protected $useTimestamps = true;     // ✅ REQUIRED
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}


