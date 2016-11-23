<?php
// DIC configuration

$container = $app->getContainer();

// twig renderer
$container['view'] = function ($c) {
    $settings = $c->get('settings')['twig'];
    $view = new \Slim\Views\Twig($settings['template_path'], [
        'cache' => $settings['cache_path'], 
        'debug' => $settings['debug'],
        'auto_reload' => $settings['auto_reload']
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));

    return $view;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// database
$container['db'] = function ($c) {
    $settings = $c->get('settings')['db'];
    $db = new DB_MySQLi($settings['host'], $settings['user'], $settings['pass'], $settings['name']);
    return $db;
};
