<?php namespace Validation;

use Closure;
use Validation\Contracts\RuleInterface;

class Validator {

	/**
	 * Input
	 *
	 * @var array
	 */
	protected $input = [];

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
	 * Create a new validator on some input
	 *
	 * @param array
	 */
	public function __construct(array $input) {
		$this->input = $input;
	}

	/**
	 * Add a message
	 *
	 * @param string
	 * @param string
	 */
	public function addMessage($message, $field = null) {
		if(null === $field) {
			$this->messages[] = $message;
		}
		else {
			// only set the first message for a field
			if( ! isset($this->messages[$field])) {
				$this->messages[$field] = $message;
			}
		}
	}

	/**
	 * Set the validator as invalid with a message as a reason
	 *
	 * @param string
	 */
	public function setInvalid($reason, $field = null) {
		$this->valid = false;
		$this->addMessage($reason, $field);
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
	 * Run rule on fields
	 */
	protected function validate() {
		foreach($this->rules as $field => $rules) {
			// get input value
			$value = isset($this->input[$field]) ? $this->input[$field] : null;

			foreach($rules as $rule) {
				if($rule instanceof Closure) {
					$this->validateCustomRule($rule, $field, $value);
				}
				else if($rule instanceof RuleInterface) {
					$this->validateRule($rule, $field, $value);
				}
			}
		}
	}

	/**
	 * Execute rule
	 *
	 * @param object
	 */
	protected function validateRule(RuleInterface $rule, $field, $value) {
		if(false === $rule->isValid($value)) {
			$this->valid = false;

			$this->addMessage(sprintf($rule->getMessage(), $rule->getLabel()), $field);
		}
	}

	/**
	 * Execute custom rule
	 *
	 * @param object
	 */
	protected function validateCustomRule(Closure $rule, $field, $value) {
		list($result, $message) = $rule($value);

		if(false === $result) {
			$this->valid = false;

			$this->addMessage(sprintf($message, $field), $field);
		}
	}

	/**
	 * Get messages
	 *
	 * @return array
	 */
	public function getMessages() {
		return $this->messages;
	}

}
