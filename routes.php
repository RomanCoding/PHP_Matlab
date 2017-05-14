<?php

$router = new Router();
$router->get('register', 'AuthController@registration');
$router->get('login', 'AuthController@login');
$router->post('login', 'AuthController@signIn');
$router->post('register', 'AuthController@SignUp');
