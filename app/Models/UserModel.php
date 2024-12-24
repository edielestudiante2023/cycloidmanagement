<?php

namespace App\Models;

use CodeIgniter\Model;

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'profile_id', 'created_at'];
    protected $useTimestamps = true;
}