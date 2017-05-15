<?php


use Core\App;

function view($name, $data = [])
{
    extract($data);
    return require '../views/' . $name . ".view.php";
}

function redirect($uri, $data = [])
{
    return header("Location: {$uri}");
}

function str_rand($length = 7)
{
    return substr(md5(rand()), 0, 7);
}

function redirectIfNotAuthenticated()
{
    if (App::get('session')->has('user_id')) {
        return true;
    }
    return redirect('login');
}