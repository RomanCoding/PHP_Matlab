<?php
session_start();

require 'vendor/autoload.php';

App::bind('db', new QueryBuilder(
    Connection::make()
));
App::bind('session', new Session());