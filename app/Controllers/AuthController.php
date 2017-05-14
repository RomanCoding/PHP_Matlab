<?php

class AuthController
{
    public function __construct()
    {
        $this->db = new QueryBuilder(Connection::make());
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
    }

    public function signIn()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // TODO: sign in
    }
}