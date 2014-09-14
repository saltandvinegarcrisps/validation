<?php namespace Validation;

class Validator {

	protected $input = array();

	protected $rules = array();

	protected $messages = array();

	protected $valid = true;

	protected $validated = false;

	public function __construct(array $input) {
		$this->input = $input;
	}

	public function addRule($rule, $field) {
		$this->rules[$field][] = $rule;
	}

	public function isValid() {
		if(false === $this->validated) {
			$this->validate();
		}

		return $this->valid;
	}

	protected function validate() {
		foreach($this->rules as $field => $rules) {
			$value = $this->input[$field];

			foreach($rules as $rule) {
				if(false === $rule->isValid($value)) {
					$this->valid = false;
					$this->messages[] = sprintf($rule->getMessage(), $field);
				}
			}
		}
	}

	public function getMessages() {
		return $this->messages;
	}

}