<?php

namespace Validation\Rules;

class Length extends AbstractRule
{
    protected $min = 0;

    protected $max = 0;

    protected $length = 0;

    public function __construct(string $range = '1,0')
    {
        list($min, $max) = explode(',', $range, 2);

        $this->setRange($min, (!!$max ? $max : 0));
    }

    public function setRange(int $min, int $max = 0)
    {
        $this->min = (int) $min;
        $this->max = (int) $max;
    }

    public function withRange(int $min, int $max = 0): RuleInterface
    {
        $this->setRange($min, $max);

        return $this;
    }

    public function isValid(): bool
    {
        $value = $this->getValue();

        $length = strlen($value);

        if ($this->max > 0 && $length > $this->max) {
            return false;
        }

        if ($length < $this->min) {
            return false;
        }

        return true;
    }

    public function getMessage(): string
    {
        if ($this->min > 0 && $this->max > 0) {
            return '%s needs to be more than '.$this->min.' characters and less than '.$this->max.' characters';
        }

        if ($this->min > 0 && $this->max == 0) {
            return '%s needs to be more than '.$this->min.' characters';
        }

        if ($this->min == 0 && $this->max > 0) {
            return '%s needs to be less than '.$this->min.' characters';
        }

        return '';
    }
}
