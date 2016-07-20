<?php

namespace Validation;

use Validation\Rules\RuleInterface;

/**
 * Creates a Validator from array of rules and input
 */
class ValidatorFactory
{
    protected function parsePattern(string $pattern): array
    {
        $params = explode(':', $pattern);
        $name = array_shift($params);

        return [$name, $params];
    }

    protected function ruleFromPattern(string $pattern): RuleInterface
    {
        list($name, $params) = $this->parsePattern($pattern);

        return $this->rule($name, $params);
    }

    protected function rule(string $name, array $params = []): RuleInterface
    {
        $class = sprintf('\\Validation\\Rules\\%s', ucfirst($name));

        $ref = new \ReflectionClass($class);
        return $ref->newInstanceArgs($params);
    }

    protected function addRulesWithOptions(ValidatorInterface $validator, string $field, array $options)
    {
        $defaults = [
            'label' => ucfirst($field),
            'message' => '',
            'messages' => [],
            'rules' => [],
        ];

        $options = array_merge($defaults, $options);

        foreach ($options['rules'] as $pattern) {
            list($name, $params) = $this->parsePattern($pattern);

            $rule = $this->rule($name, $params);
            $rule->setLabel($options['label']);

            if (! empty($options['message'])) {
                $rule->setMessage($options['message']);
            }

            if (! empty($options['messages'][$name])) {
                $rule->setMessage($options['messages'][$name]);
            }

            $validator->addRule($rule, $field);
        }
    }

    protected function addRules(ValidatorInterface $validator, string $field, array $options)
    {
        if (array_key_exists('rules', $options)) {
            return $this->addRulesWithOptions($validator, $field, $options);
        }

        foreach ($options as $pattern) {
            $rule = $this->ruleFromPattern($pattern);
            $rule->setLabel($field);

            $validator->addRule($rule, $field);
        }
    }

    public static function create(array $input, array $rules): ValidatorInterface
    {
        $validator = new Validator($input);

        foreach ($rules as $field => $options) {
            $this->addRules($validator, $field, $options);
        }

        return $validator;
    }
}
