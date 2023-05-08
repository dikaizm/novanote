<?php

$routes = require('routes.php');

function abort($code = Response::NOT_FOUND) {
    http_response_code($code);

    require "views/{$code}.php";

    die();
}

function routeToController($uri, $routes) {
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        abort();
    }
};

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

routeToController($uri, $routes);