<?php

namespace Validation\Rules;

class Alnum extends AbstractRule
{
    protected $message = '%s contains none alpha-numeric characters';

    public function isValid(): bool
    {
        $value = $this->getValue();

        return is_string($value) && 1 === preg_match('#^[A-z0-9]+$#', $value);
    }
}
