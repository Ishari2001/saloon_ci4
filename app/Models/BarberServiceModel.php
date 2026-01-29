<?php

namespace App\Models;

use CodeIgniter\Model;

class BarberServiceModel extends Model
{
    protected $table = 'barber_services';
    protected $primaryKey = 'id';
    protected $allowedFields = ['barber_id','service_id'];
    protected $useTimestamps = false; // let MySQL handle created_at
}
