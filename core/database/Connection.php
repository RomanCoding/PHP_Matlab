<?php

namespace Core\Database;

use PDO;
use PDOException;

class Connection
{
    public static function make($config = null)
    {
        if (!$config)
            $config = require '../config.php';
        try {
            $pdo = new PDO(
                $config['database']['host'] . ';dbname=' . $config['database']['dbname'],
                $config['database']['user'],
                $config['database']['password']
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $pdo;
    }
}