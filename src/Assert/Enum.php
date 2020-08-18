<?php declare(strict_types=1);

namespace Validation\Assert;

use Validation\Assertion;
use Validation\Contracts\Constraint;

class Enum extends Assertion implements Constraint
{
    /**
     * @var string
     */
    protected $message;

    /**
     * @var array<string>
     */
    protected $values;

    /**
     * @param array<string> $values
     */
    public function __construct(array $values)
    {
        $this->message = ':attribute can only be '.implode(', ', $values);
        $this->values = $values;
    }

    public function isValid($value): bool
    {
        return in_array($value, $this->values, true);
    }
}
