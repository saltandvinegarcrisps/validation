<?php declare(strict_types=1);

namespace Validation\Assert;

use Validation\Assertion;
use Validation\Constraint;

class Optional extends Assertion implements Constraint
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

    /**
     * @param string|null $value
     */
    public function isValid(?string $value): bool
    {
        return null === $value || $this->constraint->isValid($value);
    }
}
