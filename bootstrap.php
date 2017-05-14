<?php

require 'vendor/autoload.php';

$db = new QueryBuilder(Connection::make());

function redirect($uri)
{
    return header("Location: {$uri}");
}