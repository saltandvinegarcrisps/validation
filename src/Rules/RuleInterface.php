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

    public function getValue(): string;

    public function setValue(string $value);

    public function withValue(string $value): RuleInterface;
}
