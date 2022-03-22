<?php declare(strict_types=1);

namespace Validation;

use UnexpectedValueException;

abstract class Assertion implements Contracts\ConstraintMessage
{
    use Traits\ConstraintMessage;

    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * Set options for a rule
     */
    public function setOptions(array $options): void
    {
        foreach ($options as $propertyName => $value) {
            $this->setOption($propertyName, $value);
        }
    }

    /**
     * Set a option for a rule
     *
     * @param string $propertyName
     * @param string|int|bool $value
     */
    public function setOption(string $propertyName, $value): void
    {
        if (property_exists($this, $propertyName)) {
            $this->$propertyName = $value;
            return;
        }

        $propertyNameCased = str_replace('_', '', ucwords($propertyName, '_'));
        $propertyCamelName = strtolower($propertyNameCased[0]).substr($propertyNameCased, 1);

        if (property_exists($this, $propertyCamelName)) {
            $this->$propertyCamelName = $value;
            return;
        }

        throw new UnexpectedValueException(sprintf('Undefined property name "%s" on %s', $propertyName, get_class($this)));
    }
}
