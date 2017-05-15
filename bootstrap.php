<?php

require 'vendor/autoload.php';

use Core\App;
use Core\Session;
use Core\Database\Connection;
use Core\Database\QueryBuilder;

session_start();

App::bind('db', new QueryBuilder(
    Connection::make()
));
App::bind('session', new Session());