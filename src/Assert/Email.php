<?php

namespace Validation\Assert;

use Validation\Assertion;
use Validation\Constraint;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

class Email extends Assertion implements Constraint
{
    protected $message = ':attribute is not a valid email address';

    public function isValid($value): bool
    {
        $validator = new EmailValidator();
        return $validator->isValid($value, new RFCValidation());
    }
}
