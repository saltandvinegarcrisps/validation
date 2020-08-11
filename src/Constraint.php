<?php declare(strict_types=1);

namespace Validation;

interface Constraint
{
    /**
     * Check is a value passes validation rule
     *
     * @param mixed
     * @return bool
     */
    public function isValid($value): bool;

    /**
     * Get the error message
     *
     * @param string
     * @return string
     */
    public function getMessage(string $attribute): string;
}
