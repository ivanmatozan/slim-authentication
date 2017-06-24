<?php

$app->get('/', 'HomeController:index')->setName('home');

$app->group('', function () {
    $this->get('/signup', 'AuthController:getSignUp')->setName('auth.signup');
    $this->post('/signup', 'AuthController:postSignUp');

    $this->get('/signin', 'AuthController:getSignIn')->setName('auth.signin');
    $this->post('/signin', 'AuthController:postSignIn');
})->add(new \App\Middleware\GuestMiddleware($container));

$app->group('', function () {
    $this->get('/signout', 'AuthController:getSignOut')->setName('auth.signout');

    $this->get('/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
    $this->post('/password/change', 'PasswordController:postChangePassword');
})->add(new \App\Middleware\AuthMiddleware($container));