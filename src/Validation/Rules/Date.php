<?php

namespace Validation\Rules;

class Date extends Rule {

	protected $message = '%s is not a valid date';

	public function isValid($value) {
		return false !== strtotime($value);
	}

}
