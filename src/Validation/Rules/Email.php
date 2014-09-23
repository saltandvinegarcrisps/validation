<?php namespace Validation\Rules;

use Validation\Contracts\RuleInterface;

class Email implements RuleInterface {

	public function isValid($value) {
		return false !== filter_var($value, FILTER_VALIDATE_EMAIL);
	}

	public function getMessage() {
		return '%s is not a valid email address';
	}

}