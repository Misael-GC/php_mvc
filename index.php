<?php

require_once "vendor/autoload.php";
require_once "app/Helpers/function_helpers.php";

use EasyProjects\SimpleRouter\Router as Router;
use App\Controller\HomeController;

$router = new Router;

$router->get('/', function() {
    $controller = new HomeController();
    $controller->index();
});

$router->get('/contact/create', function() {
    $controller = new HomeController();
    $controller->create();
});

$router->start();