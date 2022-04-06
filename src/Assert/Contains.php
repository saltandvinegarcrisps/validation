<?php declare(strict_types=1);

namespace Validation\Assert;

use Validation\Assertion;
use Validation\Contracts\Constraint;

class Contains extends Assertion implements Constraint
{
    protected string $message = ':attribute must be an array';

    protected bool $validated = false;

    protected Constraint $constraint;

    public function __construct(Constraint $constraint)
    {
        $this->constraint = $constraint;
    }

    public function getMessage(string $attribute): string
    {
        if (!$this->validated) {
            return parent::getMessage($attribute);
        }
        return $this->constraint->getMessage($attribute);
    }

    public function isValid($values): bool
    {
        if (!is_array($values) || count($values) > 0) {
            return false;
        }
        $this->validated = true;
        return array_reduce($values, function (bool $carry, $value) {
            return $this->constraint->isValid($value) ? $carry : false;
        }, true);
    }
}
