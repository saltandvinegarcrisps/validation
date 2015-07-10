<?php

namespace Validation;

interface RuleInterface {

	public function isValid();

	public function getMessage();

	public function setMessage($message);

	public function getLabel();

	public function setLabel($label);

	public function getValue();

	public function setValue($value);

	public function withValue($value);

}
