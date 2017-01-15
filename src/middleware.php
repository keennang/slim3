<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

$app->add(function ($req, $res, $next) {
    //DO SOMETHING BEFORE THE REQUEST IS PROCESSED
    $req = $req->withAttribute('session', 'i come from middleware');

    //PROCESS THE REQUEST
    $res = $next($req, $res);
    
    //DO SOMETHING AFTER THE REQUEST HAS BEEN PROCESSED
    if ($res->getStatusCode() > 500) {
        //Do something with a server error, maybe email someone or submit a bug report
    }
    //Continue rendering
    return $res;
});

$mw = function ($request, $response, $next) {

    $request = $request->withAttribute('mwdata', 'i come from middleware');

    $response->getBody()->write('<BEFORE>');
    $response = $next($request, $response);
    $response->getBody()->write('<AFTER>');

    return $response;
};