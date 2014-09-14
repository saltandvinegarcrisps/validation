<?php

spl_autoload_register(function($class) {
	require __DIR__ . '/../src/' . str_replace('\\', '/', $class) . '.php';
});

$validation = new Validation\Validation;

$validator = $validation->create(['name' => 'Dave'], ['name' => ['required']]);

var_dump($validator->isValid());

$validator = $validation->create(['name' => ''], ['name' => ['required']]);

var_dump($validator->isValid());