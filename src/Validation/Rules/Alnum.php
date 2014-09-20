<?php namespace Validation\Rules;

class Alnum {

	public function isValid($value) {
		return ctype_alnum($value);
	}

	public function getMessage() {
		return '%s contains none alph-numeric characters';
	}

}