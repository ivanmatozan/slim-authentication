<?php

$container = $app->getContainer();

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