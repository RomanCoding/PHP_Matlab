<?php

namespace App\Controllers;

use Core\App;

class AuthController
{
    public function __construct()
    {
        $this->db = App::get('db');
    }

    public function registration()
    {
        return view('register');
    }

    public function login()
    {
        return view('login');
    }

    public function signUp()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (! filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 5) {
            App::get('session')->flash('errors', ['Registration error']);
            return redirect('register');
        }
        $this->db->insert('users', [
            'email' => $email,
            'password' => md5($password),
        ]);
        return redirect('login');
    }

    public function signIn()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if ($user = $this->db->where('users', [
            'email' => $email,
            'password' => md5($password)
        ])) {
            App::get('session')->set('user_id', $user['id']);
            return redirect('gallery');
        }
        App::get('session')->flash('errors', ['Пользователь не найден.']);
        return redirect('login');
    }

    public function logout()
    {
        App::get('session')->remove('user_id');
        return redirect('gallery');
    }
}