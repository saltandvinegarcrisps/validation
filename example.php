<?php

require __DIR__ . '/vendor/autoload.php';

$raw = [
	'name' => 'foo bar',
	'email' => '',
];

$input = filter_var_array($raw, [
	'name' => FILTER_SANITIZE_STRING,
	'email' => FILTER_SANITIZE_STRING,
]);

$rules = [
	'name' => [
		'label' => 'Your Name',
		'message' => 'My custom error message for "%s"',
		'rules' => ['required'],
	],
	'email' => [
		'label' => 'Your Email Address',
		'message' => 'Please enter a valid email address',
		'rules' => ['email'],
	],
];

$validator = \Validation\ValidatorFactory::create($input, $rules);

$valid = $validator->isValid();

var_dump($valid);

var_dump($validator->getMessages());
