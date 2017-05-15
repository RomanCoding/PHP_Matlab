<?php

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
            $errors[] = "Registration error";
            return view('register');
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
            Session::set('user_id', $user['id']);
            return redirect('gallery');
        }
        Session::flash('errors', ['Пользователь не найден.']);
        return redirect('login');
    }

    public function logout()
    {
        Session::remove('user_id');
        return redirect('gallery');
    }
}