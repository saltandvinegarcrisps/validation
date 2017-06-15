<?php

namespace Validation;

abstract class Assertion
{
    protected $message = ':attribute is not valid';

    public function __construct(array $options = [])
    {
        $options = array_intersect_key($options, array_flip(['message']));

        foreach ($options as $property => $value) {
            $this->$property = $value;
        }
    }

    public function getMessage(string $attribute): string
    {
        return str_replace(':attribute', $attribute, $this->message);
    }
}
