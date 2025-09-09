<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'password_hash', 'role'];
    protected $returnType = 'array';
    protected $useTimestamps = true;
}