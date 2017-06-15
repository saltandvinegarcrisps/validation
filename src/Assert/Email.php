<?php

namespace Validation\Assert;

use Validation\Assertion;
use Validation\Constraint;

class Email extends Assertion implements Constraint
{
    protected $message = ':attribute is not a valid email address';

    public function isValid($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }
}
