<?php

namespace Validation\Assert;

use Validation\Assertion;
use Validation\Constraint;

class Present extends Assertion implements Constraint
{
    protected $message = ':attribute must be present';

    public function isValid($value): bool
    {
        return !is_null($value);
    }
}
