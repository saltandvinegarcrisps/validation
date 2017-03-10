<?php

namespace Validation\Rules;

class Present extends AbstractRule
{
    protected $message = '%s must be set';

    public function isValid(): bool
    {
        $value = $this->getValue();

        return null !== $value;
    }
}
