<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'email'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'name'  => 'required|min_length[3]',
        'email' => 'required|valid_email'
    ];

    /**
     * Insert user data
     */
    public function saveUser(array $data)
    {

        return $this->insert($data);

       
    }


    public function saveUserProfile(array $profileData)
    {
        return $this->db
            ->table('user_profiles')
            ->insert($profileData);
    }


    
}
