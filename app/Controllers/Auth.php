<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        helper(['form']);

        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $model = new UserModel();
            $user  = $model->where('username', $username)->first();

            if ($user && password_verify($password, $user['password_hash'])) {
                session()->set('user', [
                    'id'       => $user['id'],
                    'username' => $user['username'],
                    'role'     => $user['role'],
                ]);
                return redirect()->to('/');
            }

            return redirect()->back()->with('error', 'Invalid credentials.');
        }

        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}