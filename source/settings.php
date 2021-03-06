<?php

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        'determineRouteBeforeAppMiddleware' => true,

        // Twig Renderer settings
        'twig' => [
            'template_path' => __DIR__ . '/templates/',
            'cache_path' => __DIR__ . '/cache/',
            'debug' => true,
            'auto_reload' => true,
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        
        // Database settings
        'db' => [
            'host' => 'localhost',
            'port' => '',
            'user' => 'root',
            'pass' => 'root',
            'name' => '',
            'charset' => 'utf8',
        ],

        // Mail settings
        'mail' => [
            'host' => '',
            'username' => '',
            'password' => '',
            'secure' => '',
            'port' => 2525,
            'sender_email' => 'name@domain.com',
            'sender_name' => 'name',
            'debug' => false,
        ],
    ],
];
