<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table      = 'services';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'duration_minutes',
        'price',
        'description',
        'image',
        'status',
        'seat_count' 
    ];

   protected $useTimestamps = true;
protected $createdField  = 'created_at';
protected $updatedField  = 'updated_at';

}
