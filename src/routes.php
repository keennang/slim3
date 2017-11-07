<?php

$app->get('/test[/{name}]', \TestController::class . ':general')->setName("test-general")->add($mw);

$app->get('/', function ($request, $response, $args) {
    $this->logger->info("Slim-Skeleton '/' route");

    $data = array();

    return $this->view->render($response, 'base.html', $data);
})->setName("landing");