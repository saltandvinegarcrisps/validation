<?php declare(strict_types=1);

namespace Validation;

interface Constraint
{
    /**
     * Check is a value passes validation rule
     *
     * @param string|null
     * @return boolean
     */
    public function isValid(?string $value): bool;

    /**
     * Get the error message
     *
     * @param string
     * @return string
     */
    public function getMessage(string $attribute): string;
}
