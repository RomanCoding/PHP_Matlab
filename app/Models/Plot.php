<?php

namespace App\Models;

use Core\App;
use PDO;

class Plot
{
    public static function all()
    {
        return App::get('db')->all('plots', [
            'style' => PDO::FETCH_CLASS,
            'class' => self::class
        ]);
    }

    public function create($data)
    {
        return App::get('db')->insert('plots', $data);
    }

    public function user()
    {
        return User::find($this->user_id);
    }

    public function __get($name)
    {
        if (property_exists(self::class, $name)) {
            return $this->$name;
        }
    }

}