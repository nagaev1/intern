<?php

namespace App\Core;

class Route
{
    public static function handle(string $method, string $path, array $action)
    {
        $currentMethod = $_SERVER['REQUEST_METHOD'];
        $currentUri = $_SERVER['REQUEST_URI'];
        $pattern = "#^$path/?(?:\?|$)#siD";

        if ($currentMethod !== $method || !preg_match($pattern, $currentUri)) {
            return false;
        }

        $controller = new $action[0];
        $method = $action[1];
        $controller->$method();
        exit();
    }

    public static function get($path, array $action)
    {
         self::handle("GET", $path, $action);
    }

    public static function post($path, array $action)
    {
        self::handle("POST", $path, $action);
    }

    public static function ErrorPage404()
    {
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
    }
}
