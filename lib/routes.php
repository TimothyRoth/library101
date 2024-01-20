<?php

$router = new Router\Router();

$router->add_route('/', function () {
    require BASE_DIRECTORY_URI . '/lib/App/View/hello-world.php';
});

$router->add_route('/users', function () {
    try {
        $users = new App\Controller\User();
        $users->index();
    } catch (RuntimeException $e) {
        echo $e->getMessage();
    }

});

$router->add_route('/mysql', function () {
    require BASE_DIRECTORY_URI . '/lib/App/View/mysql.php';
});

$router->run();

