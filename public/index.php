<?php

require_once __DIR__ . '/../autoload.php';

function connect() {
    $GLOBALS['db'] = new PDO(
        "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']}",
        $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'],
    );
}

function dispatch() {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $method = $_SERVER['REQUEST_METHOD'];

    switch ($path) {
        case '/':
            $controller = new TaskController();
            break;
        case '/add':
            $controller = new TaskAddController();
            break;
        case '/edit':
            $controller = new TaskEditController();
            break;
        case '/login':
            $controller = new LoginController();
            break;
        case '/logout':
            $controller = new LogoutController();
            break;
        default:
            header('Location: /');
            exit();
    }

    $controller->{$method}();
}

session_start();
connect();
dispatch();
