<?php

namespace App\Models;

use CodeIgniter\Model;

class BarberLeaveModel extends Model
{
    protected $table = 'barber_leaves';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'barber_id',
        'start_date',
        'end_date',
        'reason'
    ];
}
