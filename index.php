<?php

require_once "vendor/autoload.php";
require_once "app/Helpers/function_helpers.php";

use EasyProjects\SimpleRouter\Router as Router;
use App\Controller\HomeController;

use EasyProjects\SimpleRouter\Request;
use EasyProjects\SimpleRouter\Response;

$router = new Router;

$router->get('/', function() {
    $controller = new HomeController();
    $controller->index();
});

$router->get('/contact/create', function() {
    $controller = new HomeController();
    $controller->create();
});

$router->post('/contact', function(Request $request, Response $response) {
    // Aquí puedes manejar la lógica para almacenar el contacto
    $controller = new HomeController();
    
    $controller->store( $request, $response);
});

$router->delete('/contact/{id}', function(Request $request, Response $response) {
    // Aquí puedes manejar la lógica para eliminar el contacto
    $controller = new HomeController();
    $controller->destroy( $request, $response);
});

$router->get('/contact/edit/{id}', function(Request $request, Response $response) {
    // Aquí puedes manejar la lógica para mostrar el formulario de edición
    $controller = new HomeController();
    $controller->edit( $request, $response);
});

$router->start();