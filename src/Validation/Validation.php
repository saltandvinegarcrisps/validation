<?php namespace Validation;

use ReflectionClass;

class Validation {

	public function create(array $input, array $rules) {
		$v = new Validator($input);

		foreach($rules as $field => $methods) {
			foreach($methods as $pattern) {
				$params = explode(':', $pattern);

				$ref = new ReflectionClass('Validation\\Rules\\'.ucfirst($params[0]));
				$rule = $ref->newInstanceArgs(array_slice($params, 1));

				$v->addRule($rule, $field);
			}
		}

		return $v;
	}

}