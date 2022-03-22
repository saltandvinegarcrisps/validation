<?php declare(strict_types=1);

namespace Validation\Assert;

use DateTimeImmutable;
use DateTimeInterface;
use Validation\Assertion;
use Validation\Contracts\Constraint;

class Date extends Assertion implements Constraint
{
    protected string $message = ':attribute is not a valid date';

    protected string $format = 'Y-m-d';

    protected bool $allowZeros = false;

    public function isValid($value): bool
    {
        if (!is_string($value)) {
            return false;
        }

        if ($this->allowZeros && intval($value) === 0) {
            return true;
        }

        $date = DateTimeImmutable::createFromFormat($this->format, $value);

        if (!$date instanceof DateTimeInterface) {
            return false;
        }

        return $date->format($this->format) === $value;
    }
}
