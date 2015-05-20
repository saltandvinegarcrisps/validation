<?php namespace Validation\Rules;

use Validation\Contracts\RuleInterface;

class Date implements RuleInterface {

	public function isValid($value) {
		return false !== strtotime($value);
	}

	public function getMessage() {
		return '%s is not a valid date';
	}

}
