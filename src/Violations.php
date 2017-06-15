<?php

namespace Validation;

class Violations implements \Countable
{
    protected $attributes = [];

    public function add(string $attribute, array $constraints)
    {
        $this->attributes[$attribute] = $constraints;
    }

    protected function toWords(string $attribute): string
    {
        return str_replace(['_', '.'], ' ', $attribute);
    }

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

    public function getMessagesLine(): string
    {
        return array_reduce($this->getMessages(), function ($message, $messages) {
            return $message . implode(', ', $messages);
        }, '');
    }

    public function count(): int
    {
        return array_reduce($this->attributes, function ($carry, $constraints) {
            return $carry + count($constraints);
        }, 0);
    }
}
