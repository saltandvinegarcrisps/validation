<?php

namespace Validation\Rules;

class Email extends Rule {

	protected $message = '%s is not a valid email address';

	public function isValid($value) {
		return false !== filter_var($value, FILTER_VALIDATE_EMAIL);
	}

}
