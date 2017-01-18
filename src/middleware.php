<?php

$app->add(function ($request, $response, $next) {
    //DO SOMETHING BEFORE THE REQUEST IS PROCESSED
    $request = $request->withAttribute('mwdata', 'I come from middleware. I am attached to all routes.');

    //PROCESS THE REQUEST
    $response = $next($request, $response);
    
    //DO SOMETHING AFTER THE REQUEST HAS BEEN PROCESSED
    if ($response->getStatusCode() > 500) {
        //Do something with a server error, maybe email someone or submit a bug report
    }

    //Continue rendering
    return $response;
});

$mw = function ($request, $response, $next) {

    $request = $request->withAttribute('mwdata', 'I come from middleware. I am only attached when called.');

    $response->getBody()->write('<BEFORE>');
    $response = $next($request, $response);
    $response->getBody()->write('<AFTER>');

    return $response;
};