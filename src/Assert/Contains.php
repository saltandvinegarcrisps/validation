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

    /**
     * @param string|array|null $values
     * @return array
     */
    protected function validate($values): array
    {
        vaR_dump($values);
        if (is_array($values) && count($values) > 0) {
            $this->validated = true;
            return $values;
        }
        return [];
    }

    public function isValid($values): bool
    {
        return array_reduce($this->validate($values), function (bool $carry, $value) {
            return $this->constraint->isValid($value) ? true : $carry;
        }, false);
    }
}
