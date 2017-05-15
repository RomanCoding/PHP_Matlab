<?php

class User
{
    private $email;

    public static function find($id)
    {
        return (new QueryBuilder(Connection::make()))->where('users', [
            'id' => $id
        ], [
            'style' => PDO::FETCH_CLASS,
            'class' => 'Plot'
        ]);
    }

    public function __get($name)
    {
        if (property_exists(self::class, $name)) {
            return $this->$name;
        }
    }

}