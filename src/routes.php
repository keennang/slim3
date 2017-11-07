<?php

$app->get('/test[/{name}]', \TestController::class . ':general')->setName("test-general")->add($mw);

$app->get('/', function ($request, $response, $args) {
    return $this->view->render($response, 'blank.html');
});