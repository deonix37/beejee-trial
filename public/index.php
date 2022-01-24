<?php

require_once __DIR__ . '/../autoload.php';

function connect() {
    $conf = parse_ini_file('conf/db.ini');
    $GLOBALS['db'] = new PDO(
        "{$conf['driver']}:host={$conf['host']};dbname={$conf['dbname']}",
        $conf['username'], $conf['password'],
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
