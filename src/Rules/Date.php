<?php

namespace Validation\Rules;

class Date extends AbstractRule
{
    protected $message = '%s is not a valid date';

    public function isValid(): bool
    {
        $value = $this->getValue();

        if(is_array($value)) {
            return false;
        }

        $time = is_numeric($value) ? $value : strtotime($value);

        return false !== $time;
    }
}
