<?php declare(strict_types=1);

namespace Validation;

abstract class Assertion
{
    /**
     * @var string
     */
    protected $message = ':attribute is not valid';

    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * Set options for a rule
     *
     * @param array
     */
    public function setOptions(array $options): void
    {
        $options = array_intersect_key($options, array_flip(['message']));

        foreach ($options as $property => $value) {
            $this->$property = $value;
        }
    }

    /**
     * Get the default error message from a assertion
     *
     * @param string
     * @return string
     */
    public function getMessage(string $attribute): string
    {
        return str_replace(':attribute', $attribute, $this->message);
    }
}
