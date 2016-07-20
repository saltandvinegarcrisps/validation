<?php

namespace Validation\Rules;

interface RuleInterface
{
    public function isValid(): bool;

    public function getMessage(): string;

    public function setMessage(string $message);

    public function withMessage(string $message): RuleInterface;

    public function getLabel(): string;

    public function setLabel(string $label);

    public function withLabel(string $label): RuleInterface;

    public function getValue();

    public function setValue($value);

    public function withValue($value): RuleInterface;
}
