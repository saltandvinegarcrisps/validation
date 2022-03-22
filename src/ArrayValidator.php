<?php declare(strict_types=1);

namespace Validation;

use Closure;
use Codin\Dot\Dot;
use UnexpectedValueException;

class ArrayValidator
{
    protected array $attributes = [];

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
     * @param string $attribute
     * @param mixed $constraint
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
     * Validate a payload
     */
    public function validate(array $payload, Violations $violations = null): Violations
    {
        if (null === $violations) {
            $violations = new Violations();
        }

        foreach ($this->attributes as $attribute => $constraints) {
            $violations->add($attribute, $this->resolveConstraints((new Dot($payload))->get($attribute), $constraints));
        }

        return $violations;
    }

    /**
     * Resolve constraints against a value to return an array of failures
     *
     * @param mixed $value
     * @param array $constraints
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
