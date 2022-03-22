<?php declare(strict_types=1);

namespace Validation\Assert;

use Validation\Assertion;
use Validation\Contracts\Constraint;

class Numeric extends Assertion implements Constraint
{
    protected string $message;

    protected ?int $min = null;

    protected ?int $max = null;

    protected string $messageInvalidType = ':attribute is not a valid number';

    protected string $messageInvalidMaxLength = ':attribute must be less than or equal to :max';

    protected string $messageInvalidMinLength = ':attribute must be greater than or equal to :min';

    public function isValid($value): bool
    {
        if (filter_var($value, FILTER_VALIDATE_FLOAT) === false) {
            $this->message = $this->messageInvalidType;
            return false;
        }

        if ($this->min !== null && $value < $this->min) {
            $this->message = $this->messageInvalidMinLength;
            return false;
        }

        if ($this->max !== null && $value > $this->max) {
            $this->message = $this->messageInvalidMaxLength;
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
