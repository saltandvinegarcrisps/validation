<?php declare(strict_types=1);

namespace Validation\Assert;

use Validation\Assertion;
use Validation\Contracts\Constraint;

class Present extends Assertion implements Constraint
{
    protected $message = ':attribute must be present';

    public function isValid($value): bool
    {
        return null !== $value;
    }
}
