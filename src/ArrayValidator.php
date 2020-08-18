<?php declare(strict_types=1);

namespace Validation;

use Closure;
use UnexpectedValueException;

class ArrayValidator
{
    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * Get the constraints
     */
    public function getConstraints(): array
    {
        return $this->attributes;
    }

    /**
     * Add some constraints to a attribute
     */
    public function addConstraints(string $attribute, array $constraints): void
    {
        foreach ($constraints as $constraint) {
            $this->addConstraint($attribute, $constraint);
        }
    }

    /**
     * Removes constraints for a attribute
     */
    public function removeConstraints(string $attribute): void
    {
        unset($this->attributes[$attribute]);
    }

    /**
     * Add a single constraint to a attribute
     *
     * @param string
     * @param Contracts\Constraint|Closure
     */
    public function addConstraint(string $attribute, $constraint): void
    {
        // remove when union types are added
        if (!$constraint instanceof Contracts\Constraint && !$constraint instanceof Closure) {
            throw new UnexpectedValueException('Constraint must be either a instance of a Constraint or a Closure');
        }

        $this->attributes[$attribute][] = $constraint;
    }

    /**
     * Fetches a value from the payload
     */
    protected function value(array $payload, string $index): ?string
    {
        $item =& $payload;

        foreach (explode('.', $index) as $key) {
            if (!is_array($item) || !array_key_exists($key, $item)) {
                return null;
            }
            $item =& $item[$key];
        }

        return $item;
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
            $violations->add($attribute, $this->resolveConstraints($this->value($payload, $attribute), $constraints));
        }

        return $violations;
    }

    /**
     * Resolve constraints against a value to return an array of failures
     *
     * @return array<Contracts\ConstraintMessage>
     */
    protected function resolveConstraints($value, array $constraints): array
    {
        $resolve = static function (array $failures, $constraint) use ($value) {
            if ($constraint instanceof Closure) {
                $result = $constraint($value, new class() implements Contracts\CallbackValidator {
                    use Traits\ConstraintMutableMessage;
                });
                if ($result instanceof Contracts\ConstraintMessage) {
                    $failures[] = $result;
                }
            } elseif (!$constraint->isValid($value)) {
                $failures[] = $constraint;
            }
            return $failures;
        };

        return array_reduce($constraints, $resolve, []);
    }
}
