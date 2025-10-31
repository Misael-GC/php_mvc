<?php

require_once "vendor/autoload.php";
require_once "app/Helpers/function_helpers.php";

use EasyProjects\SimpleRouter\Router as Router;
use App\Controller\HomeController;

$router = new Router;
// $router->get('/', [HomeController::class, 'index']);
$router->get('/', function() {
    $controller = new HomeController();
    $controller->index();
});

$router->start();