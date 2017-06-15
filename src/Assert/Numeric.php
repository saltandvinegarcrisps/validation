<?php

namespace Validation\Assert;

use Validation\Assertion;
use Validation\Constraint;

class Numeric extends Assertion implements Constraint
{
    protected $message = ':attribute is not a valid number';

    public function isValid($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_FLOAT) !== false;
    }
}
