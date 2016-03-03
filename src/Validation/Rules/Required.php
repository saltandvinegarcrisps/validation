<?php

namespace Validation\Rules;

use Validation\AbstractRule;

class Required extends AbstractRule {

	protected $message = '%s is required';

	public function isValid() {
		$value = $this->getValue();

		return false === empty($value);
	}

}
