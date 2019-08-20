<?php declare(strict_types=1);

namespace Validation\Assert;

use Validation\Assertion;
use Validation\Constraint;

class Required extends Assertion implements Constraint
{
    protected $message = ':attribute is required';

    public function isValid($value): bool
    {
        return !empty($value);
    }
}
