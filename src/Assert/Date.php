<?php declare(strict_types=1);

namespace Validation\Assert;

use DateTime;
use Validation\Assertion;
use Validation\Constraint;

/**
 *
 */
class Date extends Assertion implements Constraint
{
    protected $message = ':attribute is not a valid date';

    protected $format = 'Y-m-d';

    protected $zeros = false;

    /**
     * Set options
     *
     * @param array
     */
    public function setOptions(array $options): void
    {
        $options = array_intersect_key($options, array_flip(['message', 'format', 'zeros']));

        foreach ($options as $property => $value) {
            $this->$property = $value;
        }
    }

    /**
     * @param string|null $value
     */
    public function isValid(?string $value): bool
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
