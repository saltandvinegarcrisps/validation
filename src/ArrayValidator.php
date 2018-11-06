<?php

namespace Validation;

class ArrayValidator
{
    protected $attributes = [];

    public function getConstraints(): array
    {
        return $this->attributes;
    }

    public function addConstraints(string $attribute, array $constraints): void
    {
        foreach ($constraints as $constraint) {
            $this->addConstraint($attribute, $constraint);
        }
    }

    public function removeConstraints(string $attribute): void
    {
        unset($this->attributes[$attribute]);
    }

    public function addConstraint(string $attribute, Constraint $constraint): void
    {
        $this->attributes[$attribute][] = $constraint;
    }

    protected function value(array $payload, string $key)
    {
        $keys = explode('.', $key);
        $values =& $payload;

        foreach ($keys as $key) {
            if (is_array($values) && array_key_exists($key, $values)) {
                $values =& $values[$key];
            } else {
                return null;
            }
        }

        return $values;
    }

    public function validate(array $payload, Violations $violations = null): Violations
    {
        if (null === $violations) {
            $violations = new Violations();
        }

        foreach ($this->attributes as $attribute => $constraints) {
            // get the value from the payload
            $value = $this->value($payload, $attribute);

            // filter out valid constraints
            $constraints = array_filter($constraints, function ($constraint) use ($value) {
                return !$constraint->isValid($value);
            });

            // add remaining as violations
            $violations->add($attribute, $constraints);
        }

        return $violations;
    }
}
