<?php

date_default_timezone_set('Asia/Kuala_Lumpur');

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../source/vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../source/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../source/dependencies.php';

// Register routes
require __DIR__ . '/../source/routes.php';

// Run app
$app->run();
