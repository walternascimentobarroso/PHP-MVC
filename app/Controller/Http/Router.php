<?php

namespace App\Controller\Http;

use Closure;
use Exception;
use ReflectionFunction;

class Router
{
    private $routes = [];
    private $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    private function addRoute($method, $route, $params = [])
    {
        foreach ($params as $key => $value) {
            if ($value instanceof Closure) {
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        $params['variables'] = [];
        $patternVariable = '/{(.*?)}/';

        if (preg_match_all($patternVariable, $route, $matches)) {
            $route = preg_replace($patternVariable, '(.*?)', $route);
            $params['variables'] = $matches[1];
        }

        $patternRoute = '/^' . str_replace('/', '\/', $route) . '$/';
        $this->routes[$patternRoute][$method] = $params;
    }

    /**
     * Function to add a GET, POST, PUT, DELETE route
     */
    public function __call($name, $arguments)
    {
        return $this->addRoute(strtoupper($name), $arguments[0], $arguments[1]);
    }

    private function getRoute()
    {
        $uri = $this->request->getUri();
        $httpMethod = $this->request->getHttpMethod();

        foreach ($this->routes as $patternRoute => $methods) {
            if (preg_match($patternRoute, $uri, $matches)) {
                if (isset($methods[$httpMethod])) {
                    unset($matches[0]);
                    $keys = $methods[$httpMethod]['variables'];
                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;
                    return $methods[$httpMethod];
                }
                throw new Exception("Método não permitido", 405);
            }
        }
        throw new Exception("Route not found", 404);
    }

    public function run()
    {
        try {
            $route = $this->getRoute();
            if (!isset($route['controller'])) {
                throw new Exception("A URL não pode ser processada", 500);
            }

            $args = [];

            $reflection = new ReflectionFunction($route['controller']);
            foreach ($reflection->getParameters() as $parameter) {
                $name = $parameter->getName();
                $args[$name] = isset($route['variables'][$name]) ? $route['variables'][$name] : '';
            }


            return call_user_func($route['controller'], $args);
        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }
}
