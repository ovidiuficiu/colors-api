<?php

namespace Http;

class Router
{
    /**
     * @var array $routes
     */
    protected $routes = [];

    /**
     * Store registered routes for later use
     *
     * @param $method
     * @param $arguments
     */
    public function __call($method, $arguments): void
    {
        list($route, $callback) = $arguments;
        $this->routes[] = ['method' => strtoupper($method), 'url' => $route, 'callback' => $callback];
    }

    /**
     * Call saved function for given route.
     */
    public function resolve()
    {
        $requestUrl = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        //Allow OPTIONS method for CORS pre-flight request.
        if ($requestMethod === 'OPTIONS') {
            return;
        }

        foreach($this->routes as $route) {
            $pattern = "@^" . preg_replace(
                '/:[a-zA-Z0-9]+/',
                '([a-zA-Z0-9]+)',
                $route['url']) . "$@D";
            $matches = [];

            if( $requestMethod == $route['method'] && preg_match($pattern, $requestUrl, $matches)) {
                array_shift($matches);
                $controller = new $route['callback'][0]();
                return call_user_func_array([$controller, $route['callback'][1]], $matches);
            }
        }

        $this->setRouteNotFoundHeader();
    }

    private function setRouteNotFoundHeader()
    {
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
    }

}