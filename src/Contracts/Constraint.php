<?php declare(strict_types=1);

namespace Validation\Contracts;

interface Constraint extends ConstraintMessage
{
    public function isValid(?string $value): bool;
}
