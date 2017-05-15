<?php

namespace Core;

class App
{
    protected static $container = [];

    public static function bind($key, $value)
    {
        static::$container[$key] = $value;
    }

    public static function get($key)
    {
        if (! array_key_exists($key, static::$container))
            throw new Exception("There is no {$key} bound.");
        return static::$container[$key];
    }
}