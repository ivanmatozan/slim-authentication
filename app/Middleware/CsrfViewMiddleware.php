<?php

namespace App\Middleware;

class CsrfViewMiddleware extends Middleware
{
    function __invoke($request, $response, $next)
    {
        $tokenNameKey = $this->container->csrf->getTokenNameKey();
        $tokenName = $this->container->csrf->getTokenName();
        $tokenValueKey = $this->container->csrf->getTokenValueKey();
        $tokenValue = $this->container->csrf->getTokenValue();

        $this->container->view->getEnvironment()->addGlobal('csrf', [
            'field' => '
                <input type="hidden" name="'. $tokenNameKey . '" value="'. $tokenName . '">
                <input type="hidden" name="'. $tokenValueKey . '" value="'. $tokenValue . '">
            '
        ]);

        return $next($request, $response);
    }
}