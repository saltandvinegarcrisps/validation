<?php

namespace Validation;

abstract class AbstractRule implements RuleInterface {

	protected $value;

	protected $label;

	protected $message;

	public function getValue() {
		return $this->value;
	}

	public function setValue($value) {
		$this->value = $value;
	}

	public function withValue($value) {
		$this->setValue($value);

		return $this;
	}

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
