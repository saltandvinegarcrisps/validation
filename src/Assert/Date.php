<?php declare(strict_types=1);

namespace Validation\Assert;

use DateTimeImmutable;
use DateTimeInterface;
use Validation\Assertion;
use Validation\Constraint;

class Date extends Assertion implements Constraint
{
    /**
     * @var string
     */
    protected $message = ':attribute is not a valid date';

    /**
     * @var string
     */
    protected $format = 'Y-m-d';

    /**
     * @var bool
     */
    protected $allowZeros = false;

    /**
     * Set options
     *
     * @param array
     */
    public function setOptions(array $options): void
    {
        $properties = ['message', 'format', 'allowZeros'];
        foreach (array_intersect_key($options, array_flip($properties)) as $property => $value) {
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
