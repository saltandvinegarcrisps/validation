<?php declare(strict_types=1);

namespace Validation\Assert;

use Validation\Assertion;
use Validation\Constraint;

class Required extends Assertion implements Constraint
{
    protected $message = ':attribute is required';

    /**
     * @param string|null $value
     */
    public function isValid(?string $value): bool
    {
        return null !== $value && '' !== $value;
    }
}
