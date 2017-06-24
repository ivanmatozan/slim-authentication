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

// Twig
$container['view'] = function ($container) {
    $twig = new \Slim\Views\Twig(__DIR__ . '/../resources/views');

    $twig->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    return $twig;
};


// HomeController
$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
};