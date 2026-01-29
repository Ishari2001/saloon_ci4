<?php

namespace App\Models;

use CodeIgniter\Model;

class AppointmentServiceModel extends Model
{
    protected $table = 'appointment_services';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'appointment_id',
        'service_id'
    ];

    protected $useTimestamps = false;
}

