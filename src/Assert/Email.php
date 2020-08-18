<?php declare(strict_types=1);

namespace Validation\Assert;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use Validation\Assertion;
use Validation\Contracts\Constraint;

class Email extends Assertion implements Constraint
{
    protected $message = ':attribute is not a valid email address';

    public function isValid($value): bool
    {
        if (!is_string($value)) {
            return false;
        }

        $validator = new EmailValidator();

        return $validator->isValid($value, new RFCValidation());
    }
}
