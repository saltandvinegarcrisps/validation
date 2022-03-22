<?php declare(strict_types=1);

namespace Validation;

use Countable;

class Violations implements Countable
{
    /**
     * @var array<string, array<Contracts\ConstraintMessage>>
     */
    protected array $attributes = [];

    /**
     * Add a violation
     *
     * @param string $attribute
     * @param array<Contracts\ConstraintMessage> $constraints
     */
    public function add(string $attribute, array $constraints): void
    {
        foreach ($constraints as $constraint) {
            $this->append($attribute, $constraint);
        }
    }

    /**
     * Append a violation
     *
     * @param string $attribute
     * @param Contracts\ConstraintMessage $constraint
     */
    public function append(string $attribute, Contracts\ConstraintMessage $constraint): void
    {
        $this->attributes[$attribute][] = $constraint;
    }

    /**
     * Format into more readable words
     */
    protected function toWords(string $attribute): string
    {
        return str_replace(['-', '_', '.'], ' ', $attribute);
    }

    /**
     * Get array of messages for each attribute
     *
     * @return array<string, array<string>>
     */
    public function getMessages(): array
    {
        $messages = [];

        foreach ($this->attributes as $attribute => $constraints) {
            $messages[$attribute] = array_map(function ($constraint) use ($attribute) {
                return $constraint->getMessage($this->toWords($attribute));
            }, $constraints);
        }

        return $messages;
    }

    /**
     * Get all messages as a single line
     *
     * @return string
     */
    public function getMessagesLine(): string
    {
        return array_reduce($this->getMessages(), static function ($message, $messages) {
            return $message . implode(', ', $messages);
        }, '');
    }

    /**
     * Total number of violations
     *
     * @return int
     */
    public function count(): int
    {
        return array_reduce($this->attributes, static function ($carry, $constraints) {
            return $carry + count($constraints);
        }, 0);
    }
}
