<?php declare(strict_types=1);

namespace Validation;

use UnexpectedValueException;

abstract class Assertion implements Contracts\ConstraintMessage
{
    use Traits\ConstraintMessage;

    /**
     * @param array<string> $options
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * Set options for a rule
     *
     * @param array<string> $options
     */
    public function setOptions(array $options): void
    {
        foreach ($options as $property => $value) {
            if (!property_exists($this, $property)) {
                throw new UnexpectedValueException(sprintf('Undefined property "%s" on %s', $property, get_class($this)));
            }
            $this->$property = $value;
        }
    }
}
