<?php

namespace Validation\Rules;

use Validation\AbstractRule;

class Alnum extends AbstractRule {

	protected $message = '%s contains none alpha-numeric characters';

	public function isValid() {
		$value = $this->getValue();

		return function_exists('ctype_alnum') ?
			ctype_alnum($value) :
			1 === preg_match('#^[a-zA-Z0-9]+$#', $value);
	}

}
