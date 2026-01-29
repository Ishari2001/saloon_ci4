<?php


namespace App\Models;

use CodeIgniter\Model;

class SiteSystemModel extends Model
{
    protected $table = 'site_system';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'site_name',
        'logo'
    ];

    protected $useTimestamps = false;
}
