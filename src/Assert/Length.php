<?php declare(strict_types=1);

namespace Validation\Assert;

use Validation\Assertion;
use Validation\Contracts\Constraint;

class Length extends Assertion implements Constraint
{
    protected string $message;

    protected ?int $min = null;

    protected ?int $max = null;

    protected string $messageInvalidType = ':attribute is not a string';

    protected string $messageInvalidMaxLength = ':attribute must be less than or equal to :max characters';

    protected string $messageInvalidMinLength = ':attribute must be greater than or equal to :min characters';

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
            $this->message = $this->messageInvalidType;
            return false;
        }

        $length = mb_strlen($value);

        if ($this->isMin($length)) {
            $this->message = $this->messageInvalidMinLength;
            return false;
        }

        if ($this->isMax($length)) {
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
