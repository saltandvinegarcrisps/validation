<?php

namespace Validation\Rules;

class Email extends AbstractRule
{
    protected $message = '%s is not a valid email address';

    public function isValid(): bool
    {
        if(is_array($value)) {
            return false;
        }

        return false !== filter_var($this->getValue(), FILTER_VALIDATE_EMAIL);
    }
}
