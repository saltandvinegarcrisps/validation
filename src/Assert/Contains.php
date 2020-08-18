<?php declare(strict_types=1);

namespace Validation\Assert;

use Validation\Assertion;
use Validation\Contracts\Constraint;

class Contains extends Assertion implements Constraint
{
    /**
     * @var Constraint
     */
    protected $constraint;

    /**
     * @param array<string> $values
     */
    public function __construct(Constraint $constraint)
    {
        $this->constraint = $constraint;
    }

    public function getMessage(string $attribute): string
    {
        return $this->constraint->getMessage($attribute);
    }

    public function isValid($values): bool
    {
        if (!is_array($values) || !count($values)) {
            return false;
        }

        return array_reduce($values, function (bool $carry, $value) {
            return $this->constraint->isValid($value) ? $carry : false;
        }, true);
    }
}
