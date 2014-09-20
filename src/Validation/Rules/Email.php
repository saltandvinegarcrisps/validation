<?php namespace Validation\Rules;

class Email {

	public function isValid($value) {
		return false !== filter_var($value, FILTER_VALIDATE_EMAIL);
	}

	public function getMessage() {
		return '%s is not a valid email address';
	}

}