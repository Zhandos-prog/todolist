<?php

session_start(); // стартуем сессию
ini_set('error_reporting', E_ALL); 
ini_set('display_errors', 1);

require 'vendor/autoload.php'; 
use App\Controller\Errors;

// роуты
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {

    $r->addRoute('GET', '/', function() {
        $controller = new App\Controller\HomeController();
        $controller->show_home();
    });

    $r->addRoute('POST', '/add-task', function() {
        $controller = new App\Controller\TaskController();
        $controller->add_task();
    });

    $r->addRoute('GET', '/edit-task/{id}', function($id) {
        $controller = new App\Controller\HomeController();
        $controller->show_edit_task($id['id']);
    });
    $r->addRoute('POST', '/auth', function() {
        $controller = new App\Controller\LoginController();
        $controller->auth();
    });

    $r->addRoute('POST', '/logout', function() {
        $controller = new App\Controller\LoginController();
        $controller->logout();
    });

    $r->addRoute('POST', '/update-task', function() {
        $controller = new App\Controller\TaskController();
        $controller->update_task();
    });

    $r->addRoute('POST', '/delete-task/{id}', function($id) {
        $controller = new App\Controller\TaskController();
        $controller->delete_task($id['id']);
    });
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        Errors::show_error_page();
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $handler($vars);
        // ... call $handler with $vars
        break;
}