<?php namespace Validation;

use Closure;

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
				if($rule instanceof Closure) {
					list($result, $message) = $rule($value);
					
					if(false === $result) {
						$this->valid = false;
						
						if( ! isset($this->messages[$field])) {
							$this->messages[$field] = sprintf($message, $field);
						}
					}
				}
				else {
					if(false === $rule->isValid($value)) {
						$this->valid = false;
						
						if( ! isset($this->messages[$field])) {
							$this->messages[$field] = sprintf($rule->getMessage(), $field);
						}
					}
				}
			}
		}
	}

	public function getMessages() {
		return $this->messages;
	}

}