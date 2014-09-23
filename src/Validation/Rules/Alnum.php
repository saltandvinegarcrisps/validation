<?php namespace Validation\Rules;

use Validation\Contracts\RuleInterface;

class Alnum implements RuleInterface {

	public function isValid($value) {
		return ctype_alnum($value);
	}

	public function getMessage() {
		return '%s contains none alpha-numeric characters';
	}

}