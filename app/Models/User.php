<?php

namespace App\Models;

use Core\App;
use PDO;

class User
{
    private $email;

    public static function find($id)
    {
        return App::get('db')->where('users', [
            'id' => $id
        ], [
            'style' => PDO::FETCH_CLASS,
            'class' => self::class
        ]);
    }

    public function __get($name)
    {
        if (property_exists(self::class, $name)) {
            return $this->$name;
        }
    }

}