<?php

namespace App\Validation;

use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator
{
    protected $errors = [];

    public function validate(Request $request, array $rules)
    {
        foreach ($rules as $field => $rule) {
            try {
                $rule->setName(ucfirst($field))->assert($request->getParam($field));
            } catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            }
        }

        // Add errors to session
        $_SESSION['errors'] = $this->errors;

        return $this;
    }

    public function failed(): bool
    {
        return !empty($this->errors);
    }
}
