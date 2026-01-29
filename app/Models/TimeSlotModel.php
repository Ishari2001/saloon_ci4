<?php

namespace App\Models;

use CodeIgniter\Model;

class TimeSlotModel extends Model
{
    protected $table      = 'time_slots';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'date', 'start_time', 'end_time', 'barber_id', 'is_available'
    ];
    protected $useTimestamps = true;
}
