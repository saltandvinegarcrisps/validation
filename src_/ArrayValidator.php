<?php declare(strict_types=1);

namespace Validation;

use Closure;
use Validation\Contracts\CallbackValidator;

class ArrayValidator
{
    /**
     * @var array<string, array<Constraint>>
     */
    protected $attributes = [];

    /**
     * Get the constraints
     *
     * @return array<string, array<Constraint>>
     */
    public function getConstraints(): array
    {
        return $this->attributes;
    }

    /**
     * Add some constraints to a attribute
     *
     * @param string $attribute
     * @param array<Constraint> $constraints
     */
    public function addConstraints(string $attribute, array $constraints): void
    {
        foreach ($constraints as $constraint) {
            $this->addConstraint($attribute, $constraint);
        }
    }

    /**
     * Removes constraints for a attribute
     *
     * @param string
     */
    public function removeConstraints(string $attribute): void
    {
        unset($this->attributes[$attribute]);
    }

    /**
     * Add a single constraint to a attribute
     *
     * @param string
     * @param Constraint|Closure
     */
    public function addConstraint(string $attribute, $constraint): void
    {
        $this->attributes[$attribute][] = $constraint;
    }

    /**
     * Fetches a value from the payload
     *
     * @param array $payload
     * @param string $index
     * @return mixed
     */
    protected function value(array $payload, string $index)
    {
        $keys = explode('.', $index);
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

    /**
     * Validate a payload
     *
     * @param array
     * @param  Violations|null
     * @return Violations
     */
    public function validate(array $payload, Violations $violations = null): Violations
    {
        if (null === $violations) {
            $violations = new Violations();
        }

        foreach ($this->attributes as $attribute => $constraints) {
            // get the value from the payload
            $value = $this->value($payload, $attribute);

            $closures = array_map(function ($constraint) use ($value) {
                if ($constraint instanceof Closure) {
                    return $this->executeClosure($constraint, $value);
                }

                return $constraint;
            }, $constraints);

            $constraints = array_filter($closures, static function ($constraint) use ($value): bool {
                if ($constraint instanceof CallbackValidator) {
                    return true;
                }

                if ($constraint instanceof Constraint && !$constraint->isValid($value)) {
                    return true;
                }

                return false;
            });

            // add remaining as violations
            $violations->add($attribute, $constraints);
        }

        return $violations;
    }

    protected function executeClosure($constraint, $value)
    {
        $failure = new class() implements CallbackValidator {
            private $message;

            public function setMessage(string $message): CallbackValidator
            {
                $this->message = $message;

                return $this;
            }

            public function getMessage(): string
            {
                return $this->message;
            }
        };

        return $constraint($value, $failure);
    }
}
