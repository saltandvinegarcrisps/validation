<?php

namespace Validation;

interface Constraint
{
    public function isValid($value): bool;

    public function getMessage(string $attribute): string;
}
