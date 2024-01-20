<?php

$router = new Router\Router();

$router->add_route('/', function () {
    echo 'Hello World';
});

$router->add_route('/users', function () {
    $users = new App\Controller\User();
    var_dump($users->index());
});

$router->add_route('/books', function () {
    $books = new App\Controller\Book();
    var_dump($books->index());
});

$router->add_route('/mysql', function () {
    require BASE_DIRECTORY_URI . '/lib/App/View/mysql.php';
});

$router->run();

