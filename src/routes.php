<?php
// Routes

$app->get('/test', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/test' route");

    $this->db->query(sprintf("SELECT * FROM user LIMIT 10"));
    $users = $this->db->fetch_array();

    echo "<pre>";
    print_r($users);

    //return $response->write();
});

$app->get('/hello/{name}', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/hello' route");

    $get = $request->getQueryParams();
    $data = $request->getParsedBody();

    return $response->write("Hello " . $args['name']);
});

$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
