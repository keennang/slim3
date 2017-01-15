<?php

$app->get('/test/general[/{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/test/*' route", array("key"=>"value", 'key2'=>'value2'));

    // Read app settings
    $settings = $this->get('settings')['site'];
    // Read $_GET data
    $get = $request->getQueryParams();
    // Read $_POST data
    $post = $request->getParsedBody();

    // Write to page via response
    //return $response->write("Hello " . $args['name']);

    $data = array();
    if (isset($args['name']) && $args['name']) {
        $data['name'] = $args['name'];
    }
    $data['mwdata'] = $request->getAttribute('mwdata');

    // Write to page via twig
    return $this->view->render($response, 'test.html', $data);
})->setName("test-general")->add($mw);

$app->get('/', function ($request, $response, $args) {
    $this->logger->info("Slim-Skeleton '/' route");

    $data = array();

    return $this->view->render($response, 'base.html', $data);
})->setName("landing");
