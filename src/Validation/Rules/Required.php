<?php namespace Validation\Rules;

class Required {

	public function isValid($value) {
		return false === empty($value);
	}

	public function getMessage() {
		return '%s is required';
	}

}