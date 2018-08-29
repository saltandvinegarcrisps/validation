<?php

namespace Validation\Assert;

use DateTime;
use Validation\Assertion;
use Validation\Constraint;

class Date extends Assertion implements Constraint
{
    protected $message = ':attribute is not a valid date';

    protected $format = 'Y-m-d';

    protected $zeros = false;

    public function __construct(array $options = [])
    {
        $options = array_intersect_key($options, array_flip(['message', 'format', 'zeros']));

        foreach ($options as $property => $value) {
            $this->$property = $value;
        }
    }

    public function isValid($value): bool
    {
        if (!is_string($value)) {
            return false;
        }

        $date = DateTime::createFromFormat($this->format, $value);

        if (!$date instanceof DateTime) {
            return false;
        }

        if ($this->zeros && $date->format('Y') === '-0001') {
            return true;
        }

        return $date->format($this->format) === $value;
    }
}
