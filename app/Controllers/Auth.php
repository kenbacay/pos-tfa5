<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/customers');
        }

        $method = strtolower((string) $this->request->getMethod());

        if ($method === 'post') {
            $rules = [
                'username' => 'required',
                'password' => 'required'
            ];

            if (! $this->validate($rules)) {
                return view('auth/login', [
                    'validation' => $this->validator
                ]);
            }

            $username = trim($this->request->getPost('username'));
            $password = $this->request->getPost('password');

            $userModel = new UserModel();

            $user = $userModel
                ->where('username', $username)
                ->first();

            if (
                ! $user ||
                empty($user['password']) ||
                ! password_verify($password, $user['password'])
            ) {
                return view('auth/login', [
                    'error' => 'Invalid username or password.'
                ]);
            }

            session()->regenerate(true);

            session()->set([
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'logged_in' => true
            ]);

            return redirect()->to('/customers');
        }

        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}