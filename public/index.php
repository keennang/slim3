<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require '../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require '../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require '../src/dependencies.php';

// Register middleware
require '../src/middleware.php';

// Register routes
require '../src/routes.php';

// Run app
$app->run();
