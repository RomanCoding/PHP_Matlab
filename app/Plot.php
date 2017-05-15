<?php

class Plot
{
    public static function all()
    {
        return (new QueryBuilder(Connection::make()))->all('plots', [
            'style' => PDO::FETCH_CLASS,
            'class' => 'Plot'
        ]);
    }

    public function create($data)
    {
        return (new QueryBuilder(Connection::make()))->insert('plots', $data);
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