<?php

namespace App\Middleware;

class ValidationErrorsMiddleware extends Middleware
{
    function __invoke($request, $response, $next)
    {
        $this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
        unset($_SESSION['errors']);

        return $next($request, $response);
    }
}