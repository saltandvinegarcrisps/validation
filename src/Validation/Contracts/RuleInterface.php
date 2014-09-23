<?php namespace Validation\Contracts;

interface RuleInterface {
	
	public function isValid($value);
	
	public function getMessage();
	
}