<?php declare(strict_types=1);

namespace Validation\Assert;

use Validation\Assertion;
use Validation\Constraint;

class Length extends Assertion implements Constraint
{
    protected $message;

    protected $min;

    protected $max;

    protected $message_type = ':attribute is not a string';

    protected $message_lt = ':attribute must be less than or equal to :max characters';

    protected $message_gt = ':attribute must be greater than or equal to :min characters';

    /**
     * Set options
     *
     * @param array
     */
    public function setOptions(array $options): void
    {
        $properties = ['min', 'max', 'message_type', 'message_lt', 'message_gt'];

        $options = array_intersect_key($options, array_flip($properties));

        foreach ($options as $property => $value) {
            $this->$property = $value;
        }
    }

    protected function isMin(int $length): bool
    {
        return $this->min !== null && $length < $this->min;
    }

    protected function isMax(int $length): bool
    {
        return $this->max !== null && $length > $this->max;
    }

    public function isValid($value): bool
    {
        if (!is_string($value)) {
            $this->message = $this->message_type;
            return false;
        }

        $length = mb_strlen($value);

        if ($this->isMin($length)) {
            $this->message = $this->message_gt;
            return false;
        }

        if ($this->isMax($length)) {
            $this->message = $this->message_lt;
            return false;
        }

        return true;
    }

    public function getMessage(string $attribute): string
    {
        $search = [':attribute', ':min', ':max'];

        $replace = [$attribute, $this->min, $this->max];

        return str_replace($search, $replace, $this->message);
    }
}
