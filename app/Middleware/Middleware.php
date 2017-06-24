<?php

namespace App\Middleware;

use Psr\Container\ContainerInterface;

abstract class Middleware
{
    protected $container;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}