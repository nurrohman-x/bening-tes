<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class AuthController extends BaseController
{
    public function login()
    {
        if (!empty(session('user'))) {
            return redirect('dashboard');
        }
        return view('auth/login');
    }
    public function do_login()
    {
        $user = new User();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $result = $user->where('email', $email)->first();

        if ($result) {
            if (password_verify($password, $result->password)) {
                $this->session->set('user', $result);

                return redirect()->to('dashboard');
            } else {
                echo 'Invalid email or password';
            }
        } else {
            echo 'Invalid email or password';
        }
    }

    public function register()
    {
        if (!empty(session('user'))) {
            return redirect('dashboard');
        }
        return view('auth/register');
    }
    public function do_register()
    {
        $user = new User();

        $password = $this->request->getPost('password');

        $data = $user->insert([
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        if ($data) {
            return redirect()->to('/');
        } else {
            echo 'registered error';
        }
    }

    public function logout()
    {
        session_destroy();

        return redirect()->to('/');
    }
}
