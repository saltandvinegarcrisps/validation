<?php declare(strict_types=1);

namespace Validation\Assert;

use Validation\Assertion;
use Validation\Constraint;

class Numeric extends Assertion implements Constraint
{
    protected $message;

    protected $min;

    protected $max;

    protected $message_type = ':attribute is not a valid number';

    protected $message_lt = ':attribute must be less than or equal to :max';

    protected $message_gt = ':attribute must be greater than or equal to :min';

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

    /**
     * @param string|null $value
     */
    public function isValid(?string $value): bool
    {
        if (filter_var($value, FILTER_VALIDATE_FLOAT) === false) {
            $this->message = $this->message_type;
            return false;
        }

        if ($this->min !== null && $value < $this->min) {
            $this->message = $this->message_gt;
            return false;
        }

        if ($this->max !== null && $value > $this->max) {
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
