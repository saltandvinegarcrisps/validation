<?php

namespace Validation;

class Validator {

	/**
	 * values
	 *
	 * @var array
	 */
	protected $values = [];

	/**
	 * Collection of rules
	 *
	 * @var array
	 */
	protected $rules = [];

	/**
	 * Collection of messages
	 *
	 * @var array
	 */
	protected $messages = [];

	/**
	 * Is the validator valid
	 *
	 * @var bool
	 */
	protected $valid = true;

	/**
	 * Has the validation executed
	 *
	 * @var bool
	 */
	protected $validated = false;

	/**
	 * Nuber of executed rules
	 *
	 * @var integer
	 */
	protected $executed = 0;

	/**
	 * Create a new validator on some input
	 *
	 * @param array
	 */
	public function __construct(array $values = []) {
		$this->values = $values;
	}

	/**
	 * Get constructed values
	 *
	 * @return array
	 */
	public function getValues() {
		return $this->values;
	}

	/**
	 * Get messages
	 *
	 * @return array
	 */
	public function getMessages() {
		return $this->messages;
	}

	/**
	 * Add a message
	 *
	 * @param string
	 * @param string
	 */
	public function addMessage($message) {
		$this->messages[] = $message;

		return $this;
	}

	/**
	 * Get assigned rules
	 *
	 * @return array
	 */
	public function getRules() {
		return $this->rules;
	}

	/**
	 * Add a custom rule
	 *
	 * @param object
	 * @param string
	 */
	public function addRule($rule, $field) {
		$this->rules[$field][] = $rule;
		$this->validated = false;

		return $this;
	}

	/**
	 * Set the validator as invalid with a message as a reason
	 *
	 * @param string
	 */
	public function setInvalid($message) {
		if( ! is_string($message)) {
			throw new \InvalidArgumentException('message must be a string');
		}

		$this->validate();

		$this->valid = false;

		return $this->addMessage($message);
	}

	/**
	 * Is the validator valid?
	 *
	 * @return bool
	 */
	public function isValid() {
		if(false === $this->validated) {
			$this->validate();
		}

		return $this->valid;
	}

	/**
	 * Return the number of executed rules
	 *
	 * @return integer
	 */
	public function countExecutedRules() {
		return $this->executed;
	}

	/**
	 * Run rule on fields
	 */
	protected function validate() {
		foreach($this->rules as $field => $rules) {
			// get input value
			$value = array_key_exists($field, $this->values) ? $this->values[$field] : null;

			foreach($rules as $rule) {
				if($rule instanceof \Closure) {
					$this->validateCustomRule($rule, $field, $value);
				}
				else if($rule instanceof RuleInterface) {
					$this->validateRule($rule, $field, $value);
				}
			}
		}

		$this->validated = true;
	}

	/**
	 * Execute rule
	 *
	 * @param object
	 */
	protected function validateRule(RuleInterface $rule, $field, $value) {
		$result = $rule->withValue($value)->isValid();

		$this->executed += 1;

		if(false === $result) {
			$this->valid = false;

			$message = sprintf($rule->getMessage(), $rule->getLabel());

			$this->addMessage($message);
		}
	}

	/**
	 * Execute custom rule
	 *
	 * @param object
	 */
	protected function validateCustomRule(\Closure $rule, $field, $value) {
		list($result, $message) = $rule($value);

		$this->executed += 1;

		if(false === $result) {
			$this->valid = false;

			$message = sprintf($message, $field);

			$this->addMessage($message);
		}
	}

}
