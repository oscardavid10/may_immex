<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $model = new UserModel();
        $model->insert([
            'username'      => 'admin',
            'password_hash' => password_hash('secret', PASSWORD_DEFAULT),
            'role'          => 'admin',
        ]);
    }
}