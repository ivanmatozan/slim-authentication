<?php

// Start session
session_start();

// Composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// Instantiate application
$settings = require __DIR__ . '/settings.php';
$app = new Slim\App($settings);

// Container
require __DIR__ . '/container.php';

// Application routes
require __DIR__ . '/routes.php';