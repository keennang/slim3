<?php

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

    $view->getEnvironment()->addGlobal('session', $_SESSION);

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
    $dsn = "mysql:host={$settings['host']};dbname={$settings['name']};charset={$settings['charset']}";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $db = new PDO($dsn, $settings['user'], $settings['pass'], $opt);
    return $db;
};

// mail
$container['mail'] = function ($c) {
    $settings = $c->get('settings')['mail'];
    $mail = new PHPMailer;
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = 'html';
    if ($settings['host']) {
        $mail->isSMTP();
        $mail->Host = $settings['host'];
        $mail->Port = $settings['port'];
        $mail->SMTPSecure = $settings['secure'];
        $mail->SMTPAuth = true;
        $mail->Username = $settings['username'];
        $mail->Password = $settings['password'];
    } else {
        $mail->isSendmail();
    }
    return $mail;
};
