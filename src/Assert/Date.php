<?php

namespace Validation\Assert;

use DateTime;
use Validation\Assertion;
use Validation\Constraint;

class Date extends Assertion implements Constraint
{
    protected $message = ':attribute is not a valid date';

    protected $format = 'Y-m-d';

    public function __construct(array $options = [])
    {
        $options = array_intersect_key($options, array_flip(['message', 'format']));

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

        return $date instanceof DateTime && $date->format($this->format) === $value;
    }
}
