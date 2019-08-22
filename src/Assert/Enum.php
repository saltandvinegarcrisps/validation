<?php declare(strict_types=1);

namespace Validation\Assert;

use Validation\Assertion;
use Validation\Constraint;

class Enum extends Assertion implements Constraint
{
    protected $message;

    protected $values;

    public function __construct(array $values)
    {
        $this->values = $values;
        $this->message = ':attribute can only be '.implode(', ', $values);
    }

    public function isValid($value): bool
    {
        return in_array($value, $this->values);
    }
}
