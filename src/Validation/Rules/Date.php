<?php

namespace Validation\Rules;

use Validation\AbstractRule;

class Date extends AbstractRule {

	protected $message = '%s is not a valid date';

	public function isValid() {
		$value = $this->getValue();

		$time = is_numeric($value) ? $value : strtotime($value);

		return false !== $time;
	}

}
