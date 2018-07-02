<?php

namespace App\Middleware;


class InputMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        if (isset($_SESSION['input'])) {
            $request = $request->withAttribute('input', $_SESSION['input']);
            $this->view->getEnvironment()->addGlobal('input', $_SESSION['input']);
            unset($_SESSION['input']);
        }

        $response = $next($request, $response);

        if ($request->getParams()) {
            $_SESSION['input'] = $request->getParams();
        }

        return $response;
    }
}