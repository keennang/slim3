<?php

$app->get('/test[/{name}]', 'TestController:general')->setName("test-general");

$app->get('/', function ($request, $response, $args) {
    return $this->view->render($response, 'blank.html');
});