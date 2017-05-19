<?php

namespace Validation\Rules;

class Required extends AbstractRule
{
    protected $message = '%s is required';

    public function isValid(): bool
    {
        $value = $this->getValue();

        if(is_array($value)) {
            return !empty($value);
        }

        return '' !== (string) $value;
    }
}
