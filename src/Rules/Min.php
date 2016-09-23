<?php

namespace Validation\Rules;

class Min extends AbstractRule
{
    protected $length = 0;

    public function __construct(int $length = 0)
    {
        $this->length = $length;
    }

    public function isValid(): bool
    {
        $value = $this->getValue();

        return strlen($value) >= $this->length;
    }

    public function getMessage(): string
    {
        return '%s needs to be more than '.$this->length.' characters';
    }
}
