<?php

namespace Validation;

class Validation {

	protected function parsePattern($pattern) {
		$params = explode(':', $pattern);
		$name = array_shift($params);

		return [$name, $params];
	}

	protected function ruleFromPattern($pattern) {
		list($name, $params) = $this->parsePattern($pattern);

		return $this->rule($name, $params);
	}

	protected function rule($name, array $params = []) {
		$class = sprintf('Validation\\Rules\\%s', ucfirst($name));

		$ref = new \ReflectionClass($class);
		return $ref->newInstanceArgs($params);
	}

	protected function addRulesWithOptions($validator, $field, array $options) {
		$defaults = [
			'label' => ucfirst($field),
			'message' => '',
			'messages' => [],
			'rules' => [],
		];

		$options = array_merge($defaults, $options);

		foreach($options['rules'] as $pattern) {
			list($name, $params) = $this->parsePattern($pattern);

			$rule = $this->rule($name, $params);
			$rule->setLabel($options['label']);

			if( ! empty($options['message'])) {
				$rule->setMessage($options['message']);
			}

			if( ! empty($options['message'][$name])) {
				$rule->setMessage($options['message'][$name]);
			}

			$validator->addRule($rule, $field);
		}
	}

	protected function addRules($validator, $field, array $options) {
		if(array_key_exists('rules', $options)) {
			return $this->addRulesWithOptions($validator, $field, $options);
		}

		foreach($options as $pattern) {
			$rule = $this->ruleFromPattern($pattern);
			$rule->setLabel($field);

			$validator->addRule($rule, $field);
		}
	}

	public function create(array $input, array $rules) {
		$validator = new Validator($input);

		foreach($rules as $field => $options) {
			$this->addRules($validator, $field, $options);
		}

		return $validator;
	}

}
