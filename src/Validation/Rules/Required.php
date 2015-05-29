<?php

namespace Validation\Rules;

class Required extends Rule {

	protected $message = '%s is required';

	public function isValid($value) {
		return false === empty($value);
	}

}
