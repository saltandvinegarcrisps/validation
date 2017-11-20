<?php

namespace Validation\Assert;

use Validation\Assertion;
use Validation\Constraint;

class ArrayOf extends Assertion implements Constraint
{
    protected $message = ':attribute is not a valid list';

    protected $constraint;

    public function __construct(Constraint $constraint)
    {
        $this->constraint = $constraint;
    }

    public function isValid($array): bool
    {
        if (!is_array($array)) {
            return false;
        }

        foreach ($array as $value) {
            if (!$this->constraint->isValid($value)) {
                return false;
            }
        }

        return true;
    }
}
