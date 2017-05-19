<?php

namespace Validation\Rules;

class Max extends AbstractRule
{
    protected $length = 0;

    public function __construct(int $length = 0)
    {
        $this->length = $length;
    }

    public function isValid(): bool
    {
        $value = $this->getValue();

        if(is_array($value)) {
            $length = count($value);
        } else {
            $length = strlen($value);
        }

        return $length <= $this->length;
    }

    public function getMessage(): string
    {
        return '%s needs to be less than '.$this->length.' characters';
    }
}
