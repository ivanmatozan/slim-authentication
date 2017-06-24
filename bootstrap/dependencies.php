<?php

$container = $app->getContainer();

// Boot Eloquent
$capsule = new \Illuminate\Database\Capsule\Manager();
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// Add Eloquent to container
$container['db'] = function () use ($capsule) {
    return $capsule;
};

// Flash messages
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

// Auth
$container['auth'] = function ($container) {
    return new \App\Auth\Auth();
};

// Twig
$container['view'] = function ($container) {
    $twig = new \Slim\Views\Twig(__DIR__ . '/../resources/views');

    $twig->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    $twig->getEnvironment()->addGlobal('auth', [
        'check' => $container->auth->check(),
        'user' => $container->auth->user()
    ]);

    $twig->getEnvironment()->addGlobal('flash', $container->flash);

    return $twig;
};

// CSRF
$container['csrf'] = function ($container) {
    return new \Slim\Csrf\Guard();
};

// Validator
$container['validator'] = function () {
    return new \App\Validation\Validator();
};

// Validation rules
Respect\Validation\Validator::with('App\Validation\Rules');

// HomeController
$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
};

// AuthController
$container['AuthController'] = function ($container) {
    return new \App\Controllers\Auth\AuthController($container);
};

