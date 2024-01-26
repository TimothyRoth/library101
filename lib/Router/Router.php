<?php

namespace Router;

use Exception;
use JetBrains\PhpStorm\NoReturn;

class Router
{

    public array $routes = [];
    private array $allowedMethods = ['GET', 'POST'];

    /*
     * @param string|array|null $method
     * @param string $route
     * @param callable $action
     * @return void
     * @throws Exception
     * */

    public function add($method = null, string $route, callable $action): void
     {
         $nMethod = strtoupper($method);
         if (!in_array($nMethod, $this->allowedMethods, true)) {
             throw new Exception('Invalid request method');
         }
     
         $key = $nMethod . ':' . $route;

         if (isset($this->routes[$key])) {
             throw new Exception('Route already exists');
         }
     
         $this->routes[$key]['action'] = $action;
     }
     

    /*
     * @return void
     * @throws Exception
     * */

    public function run(): void
    {
        $path = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
    
        if (str_contains($path, '?')) {
            $path = substr($path, 0, strpos($path, '?'));
        }
    
        $key = $method . ':' . $path;
        $route = $this->routes[$key] ?? false;
    
        if ($route === false) {
            $this->abort('404');
        }
    
        $action = $route['action'];
        $action();
    }
    
    /*
     * @param string $code
     * @return void
     * @throws Exception
     * */

    #[NoReturn] private function abort(string $code): void
    {
        http_response_code((int) $code) ;
        require BASE_DIRECTORY_URI . "/lib/App/View/{$code}.php";
        exit;
    }
}