<?php

namespace Validation;

interface ValidatorInterface
{
    public function getValues(): array;

    public function getMessages(): array;

    public function addMessage(string $message);

    public function getRules(): array;

    public function addRule($rule, string $field);

    public function setInvalid(string $message);

    public function isValid(): bool;

    public function countExecutedRules(): int;
}
