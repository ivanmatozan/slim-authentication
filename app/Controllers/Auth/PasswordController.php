<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use Respect\Validation\Validator as v;

class PasswordController extends Controller
{
    public function getChangePassword($request, $response)
    {
        return $this->view->render($response, 'auth/password/change.twig');
    }

    public function postChangePassword($request, $response)
    {
        $validation = $this->validator->validate($request, [
            'password_old' => v::noWhitespace()->notEmpty()->matchesPassword($this->auth->user()->password),
            'password' => V::noWhitespace()->notEmpty()
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->container->router->pathFor('auth.password.change'));
        }

        $this->auth->user()->setPassword($request->getParam('password'));

        $this->flash->addMessage('success', 'Your password was changed');

        return $response->withRedirect($this->container->router->pathFor('home'));
    }
}