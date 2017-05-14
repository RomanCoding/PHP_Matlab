<?php
require 'vendor/autoload.php';
$db = new QueryBuilder(Connection::make());
$email = $_POST['email'];
$password = $_POST['password'];

if (! filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 3) {
    $errors[] = "Registration error";
    return require "index.php";
}

$db->insert('users', [
    'email' => $email,
    'password' => md5($password),
]);