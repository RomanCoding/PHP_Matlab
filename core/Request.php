<?php

class Request
{
    public static function uri()
    {
        return isset($_SERVER['PATH_INFO']) ? trim($_SERVER['PATH_INFO'], '/') : trim($_SERVER['REQUEST_URI'], '/');
    }
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}