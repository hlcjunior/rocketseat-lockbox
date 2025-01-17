<?php

namespace Core;

class Route
{
    public array $routes = [];

    public function addRoute(string $httpMethod, string $uri, string|array $controller = null): void
    {
        if (is_string($controller)) {
            $data = [
                'class' => $controller,
                'method' => '__invoke'
            ];
        }

        if (is_array($controller)) {
            $data = [
                'class' => $controller[0],
                'method' => $controller[1]
            ];
        }

        $this->routes[$httpMethod][$uri] = $data ?? [];
    }

    public function get(string $uri, string|array $controller = null): static
    {
        $this->addRoute('GET', $uri, $controller);
        return $this;
    }

    public function post(string $uri, string|array $controller = null): static
    {
        $this->addRoute('POST', $uri, $controller);
        return $this;
    }

    public function run(): void
    {
        $uri = '/' . str_replace(getBaseURL(), '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $httpMethod = $_SERVER['REQUEST_METHOD'];

        if (!isset($this->routes[$httpMethod][$uri])) {
            abort(404);
        }

        $routeInfo = $this->routes[$httpMethod][$uri];

        $class = $routeInfo['class'];
        $method = $routeInfo['method'];

        if(!class_exists($class)){
            abort(404);
        }

        $c = new $class();
        $c->$method();

        exit;
    }
}
