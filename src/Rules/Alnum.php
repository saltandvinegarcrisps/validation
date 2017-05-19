<?php

namespace Validation\Rules;

class Alnum extends AbstractRule
{
    protected $message = '%s contains none alpha-numeric characters';

    public function isValid(): bool
    {
        $value = $this->getValue();

        if(is_string($value) || is_int($value)) {
            return 1 === preg_match('#^[A-z0-9]+$#', $value);
        }

        return false;
    }
}
