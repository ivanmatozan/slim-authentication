<?php

// Start session
session_start();

// Composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// Instantiate application
$settings = require __DIR__ . '/settings.php';
$app = new Slim\App($settings);

// Container
require __DIR__ . '/dependencies.php';

// Attach middleware
$app->add(new App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new App\Middleware\OldInputMiddleware($container));

// Application routes
require __DIR__ . '/routes.php';