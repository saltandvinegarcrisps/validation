<?php

namespace Validation\Rules;

class Length extends Rule {

	protected $min;

	protected $max;

	protected $length = 0;

	public function __construct($range) {
		$params = explode(',', $range);

		if(count($params) == 2) {
			list($this->min, $this->max) = $params;
		}
	}

	public function isValid($value) {
		$length = strlen($value);

		if(false === $this->isValidMax($length) && false === $this->isValidMin($length)) {
			return false;
		}

		return true;
	}

	protected function isValidMax($length) {
		if(null === $this->max) return true;

		if($length > $this->max) {
			return false;
		}

		return true;
	}

	protected function isValidMin($length) {
		if(null === $this->min) return true;

		if($length < $this->min) {
			return false;
		}

		return true;
	}

	public function getMessage() {
		return '%s need to be more than '.$this->min.' characters and less than '.$this->max.' characters';
	}

}
