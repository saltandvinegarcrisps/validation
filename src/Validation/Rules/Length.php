<?php namespace Validation\Rules;

class Length {
	
	protected $min;
	
	protected $max;
	
	protected $length = 0;
	
	public function __construct($range) {
		if(strpos(',', $range) === false) {
			$range .= ',';
		}
		
		list($min, $max) = explode(',', $range);
		
		$this->min = '' === $min ? null : (int) $min;
		$this->max = '' === $max ? null : (int) $max;
	}

	public function isValid($value) {
		$this->length = strlen($value);
		
		if($this->isValidMax() and $this->isValidMin()) {
			return false;
		}
		
		return true;
	}
	
	protected function isValidMax() {
		if(null === $this->max) return true;
		
		if($this->length > $this->max) {
			return false;
		}
		
		return true;
	}
	
	protected function isValidMin() {
		if(null === $this->min) return true;
		
		if($this->length < $this->min) {
			return false;
		}
		
		return true;
	}

	public function getMessage() {
		if($this->min > 0 and $this->max > 0) {
			return '%s need to be more than '.$this->min.' characters and less than '.$this->max.' characters';
		}
		
		if($this->max > 0) {
			return '%s need to be less than '.$this->max.' characters';
		}
		
		if($this->min > 0) {
			return '%s need to be more than '.$this->min.' characters';
		}
	}

}