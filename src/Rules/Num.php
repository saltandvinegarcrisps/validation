<?php

namespace Validation\Rules;

class Num extends AbstractRule
{
    protected $message = '%s contains none numeric characters';

    public function isValid(): bool
    {
        $value = $this->getValue();

        if(is_array($value)) {
            return false;
        }

        return 1 === preg_match('#^[0-9]+$#', (string) $value);
    }
}
