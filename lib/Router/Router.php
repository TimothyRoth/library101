<?php

namespace Router;

class Router
{

    public array $routes = [];

    /*
     * @param string $route
     * @param callable $callback
     * @return void
     * @throws Exception
     * */

    public function add_route(string $route, callable $action): void
    {
        $this->routes[$route] = $action;
    }

    /*
     * @return void
     * @throws Exception
     * */
    public function run(): void
    {
        $path = $_SERVER['REQUEST_URI'];
        $action = $this->routes[$path] ?? false;
        if($action === false):
            require BASE_DIRECTORY_URI . '/lib/App/View/404.php';
            exit;
        endif;

        echo $action();
    }
}