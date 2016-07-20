<?php

namespace Validation;

use Validation\Rules\RuleInterface;

/**
 * Creates a Validator from array of rules and input
 */
class ValidatorFactory
{
    public static function create(array $input, array $rules): ValidatorInterface
    {
        $validator = new Validator($input);

        foreach ($rules as $field => $options) {
            static::addRules($validator, $field, $options);
        }

        return $validator;
    }

    protected static function parsePattern(string $pattern): array
    {
        $params = explode(':', $pattern);
        $name = array_shift($params);

        return [$name, $params];
    }

    protected static function ruleFromPattern(string $pattern): RuleInterface
    {
        list($name, $params) = static::parsePattern($pattern);

        return static::rule($name, $params);
    }

    protected static function rule(string $name, array $params = []): RuleInterface
    {
        $class = sprintf('\\Validation\\Rules\\%s', ucfirst($name));

        $ref = new \ReflectionClass($class);
        return $ref->newInstanceArgs($params);
    }

    protected static function addRulesWithOptions(ValidatorInterface $validator, string $field, array $options)
    {
        $defaults = [
            'label' => ucfirst($field),
            'message' => '',
            'messages' => [],
            'rules' => [],
        ];

        $options = array_merge($defaults, $options);

        foreach ($options['rules'] as $pattern) {
            list($name, $params) = static::parsePattern($pattern);

            $rule = static::rule($name, $params);
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

    protected static function addRules(ValidatorInterface $validator, string $field, array $options)
    {
        if (array_key_exists('rules', $options)) {
            return static::addRulesWithOptions($validator, $field, $options);
        }

        foreach ($options as $pattern) {
            $rule = static::ruleFromPattern($pattern);
            $rule->setLabel($field);

            $validator->addRule($rule, $field);
        }
    }
}
