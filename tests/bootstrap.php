<?php

spl_autoload_register(function($class) {
	$file = str_replace(array('\\', '_'), DIRECTORY_SEPARATOR, ltrim($class, '\\'));
	$path = realpath(__DIR__ . '/../src') . '/' . $file . '.php';

	if(file_exists($path)) return require $path;
});