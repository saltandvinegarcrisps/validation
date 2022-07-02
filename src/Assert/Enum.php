<?php declare(strict_types=1);

namespace Validation\Assert;

use Validation\Assertion;
use Validation\Contracts\Constraint;

class Enum extends Assertion implements Constraint
{
    protected string $message;

    /**
     * @var array<int|string, int|string>
     */
    protected array $values;

    /**
     * @param array<int|string, int|string> $values
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
