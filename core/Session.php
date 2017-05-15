<?php

namespace Core;

class Session
{

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        if (key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        }
        if (isset($_SESSION['flash']) && key_exists($key, $_SESSION['flash'])) {
            $value = $_SESSION['flash'][$key];
            $_SESSION['flash'] = [];
            return $value;
        }
        return null;
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public function has($key)
    {
        return key_exists($key, $_SESSION);
    }

    public function hasFlash($key)
    {
        return (isset($_SESSION['flash']) && key_exists($key, $_SESSION['flash']));
    }

    public function flash($key, $value)
    {
        $_SESSION['flash'][$key] = $value;
    }
}