<?php

namespace Validation\Rules;

use Validation\AbstractRule;

class Email extends AbstractRule {

	protected $message = '%s is not a valid email address';

	public function isValid() {
		return false !== filter_var($this->getValue(), FILTER_VALIDATE_EMAIL);
	}

}
