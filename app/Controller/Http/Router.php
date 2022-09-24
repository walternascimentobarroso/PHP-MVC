<?php

namespace App\Controller\Http;

use Exception;

class Router
{
    private static $routes = [];

    private static function add($method, $route, $params = [])
    {
        $params['variables'] = [];
        $params['controller'] = $params[0];
        $params['action'] = $params[1];
        unset($params[0], $params[1]);

        $patternVariable = '/{(.*?)}/';

        if (preg_match_all($patternVariable, $route, $matches)) {
            $route = preg_replace($patternVariable, '(.*?)', $route);
            $params['variables'] = $matches[1];
        }

        $patternRoute = '/^' . str_replace('/', '\/', $route) . '$/';
        self::$routes[$patternRoute][$method] = $params;
    }

    /**
     * Function to add a GET, POST, PUT, DELETE route
     */
    public static function __callStatic($name, $arguments)
    {
        return self::add(strtoupper($name), $arguments[0], $arguments[1]);
    }

    private static function getRoute()
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '';
        $httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';

        foreach (self::$routes as $patternRoute => $methods) {
            if (preg_match($patternRoute, $uri, $matches)) {
                if (isset($methods[$httpMethod])) {
                    unset($matches[0]);
                    $keys = $methods[$httpMethod]['variables'];
                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
                    return $methods[$httpMethod];
                }
                throw new Exception("Método não permitido", 405);
            }
        }
        throw new Exception("Route not found", 404);
    }

    public static function run()
    {
        try {
            $route = self::getRoute();
            $controller = $route['controller'];
            $controller_object = new $controller();
            $action = $route['action'];
            $args = $route['variables'] ?? [];
            return call_user_func([$controller_object, $action], $args);
        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo $e->getMessage();
        }
    }
}
