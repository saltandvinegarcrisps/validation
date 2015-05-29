<?php

namespace Validation\Rules;

use Validation\Contracts\RuleInterface;

abstract class Rule implements RuleInterface {

	protected $label;

	protected $message = '%s error';

	public function getLabel() {
		return $this->label;
	}

	public function setLabel($label) {
		$this->label = $label;
	}

	public function getMessage() {
		return $this->message;
	}

	public function setMessage($message) {
		$this->message = $message;
	}

}
