<?php

namespace App\Middleware;

class OldInputMiddleware extends Middleware
{
    function __invoke($request, $response, $next)
    {
        $this->container->view->getEnvironment()->addGlobal('old', $_SESSION['old']);
        unset($_SESSION['old']);

        return $next($request, $response);
    }
}