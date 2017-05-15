<?php

namespace Core;

use Exception;

class Router
{
    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }
    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }
    public function load($file)
    {
        $this->routes = array_merge($this->routes, require $file);
    }
    public function direct($uri, $method)
    {
        if (key_exists($uri, $this->routes[$method])) {
            $action = explode('@', $this->routes[$method][$uri]);
            return $this->getAction(...$action);
        }
        throw new Exception('Route is not defined.');
    }
    protected function getAction($controller, $method)
    {
        $controller = '\\App\\Controllers\\' . $controller;
        if (! method_exists($controller = new $controller, $method))
            throw new Exception('Method not exists.');
        return $controller->$method();
    }
}