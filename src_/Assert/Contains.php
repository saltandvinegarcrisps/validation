<?php declare(strict_types=1);

namespace Validation\Assert;

use Validation\Assertion;
use Validation\Constraint;

class Contains extends Assertion implements Constraint
{
    /**
     * @var string
     */
    protected $message = ':attribute is not a valid list';

    /**
     * @var Constraint
     */
    protected $constraint;

    public function __construct(Constraint $constraint, array $options = [])
    {
        parent::__construct($options);
        $this->constraint = $constraint;
    }

    /**
     * @param string|null $value
     */
    public function isValid(?string $value): bool
    {
        if (!is_array($value)) {
            return false;
        }

        foreach ($value as $item) {
            if (!$this->constraint->isValid($item)) {
                return false;
            }
        }

        return true;
    }
}
