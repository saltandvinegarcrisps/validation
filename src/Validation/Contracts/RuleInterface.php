<?php namespace Validation\Contracts;

interface RuleInterface {

	public function isValid($value);

	public function getMessage();

	public function setMessage($message);

	public function getLabel();

	public function setLabel($label);

}
