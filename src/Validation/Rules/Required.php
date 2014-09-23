<?php namespace Validation\Rules;

use Validation\Contracts\RuleInterface;

class Required implements RuleInterface {

	public function isValid($value) {
		return false === empty($value);
	}

	public function getMessage() {
		return '%s is required';
	}

}