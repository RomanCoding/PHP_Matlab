<?php

$router = new Router();
$router->get('register', 'AuthController@registration');
$router->post('register', 'AuthController@SignUp');
$router->get('login', 'AuthController@login');
$router->get('logout', 'AuthController@logout');
$router->post('login', 'AuthController@signIn');
$router->get('work', 'MatlabController@index');
$router->post('work', 'MatlabController@execute');
$router->get('gallery', 'PlotController@index');
$router->post('gallery', 'PlotController@store');
