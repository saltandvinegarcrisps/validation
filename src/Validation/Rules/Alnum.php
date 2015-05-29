<?php

namespace Validation\Rules;

class Alnum extends Rule {

	protected $message = '%s contains none alpha-numeric characters';

	public function isValid($value) {
		return ctype_alnum($value);
	}

}
