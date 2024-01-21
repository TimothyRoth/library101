<?php

$router = new Router\Router();
$app = new App\App();

$router->add('GET', '/', function () {
    require BASE_DIRECTORY_URI . '/lib/App/View/hello-world.php';
});

$router->add('POST', '/', function() {
    // ... insert view
    print_r("POST request made");
});

$router->add('GET', '/users', function () use ($app) {
    try {
        $users = $app->make('user::controller');
        $users->index();
        echo "users.php";
    } catch (RuntimeException $e) {
        echo $e->getMessage();
    }
});

$router->add('GET', '/mysql', function () {
    require BASE_DIRECTORY_URI . '/lib/App/View/mysql.php';
});

$router->run();

