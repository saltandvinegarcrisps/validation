<?php declare(strict_types=1);

namespace Validation\Assert;

use Validation\Assertion;
use Validation\Contracts\Constraint;

class Required extends Assertion implements Constraint
{
    protected string $message = ':attribute is required';

    public function isValid($value): bool
    {
        return null !== $value;
    }
}
