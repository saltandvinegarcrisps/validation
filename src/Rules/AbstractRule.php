<?php

namespace Validation\Rules;

abstract class AbstractRule implements RuleInterface
{
    protected $value = '';

    protected $label = '';

    protected $message = '';

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value)
    {
        $this->value = $value;
    }

    public function withValue(string $value): RuleInterface
    {
        $this->setValue($value);

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label)
    {
        $this->label = $label;
    }

    public function withLabel(string $label): RuleInterface
    {
        $this->setLabel($label);

        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    public function withMessage(string $message): RuleInterface
    {
        $this->setMessage($message);

        return $this;
    }
}
