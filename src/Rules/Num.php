<?php

namespace Validation\Rules;

class Num extends AbstractRule
{
    protected $message = '%s contains none numeric characters';

    public function isValid(): bool
    {
        $value = $this->getValue();

        return is_string($value) && 1 === preg_match('#^[0-9]+$#', $value);
    }
}
