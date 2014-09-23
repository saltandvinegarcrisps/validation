<?php namespace Validation\Contracts;

interface RuleInterface {
    
    public function isValid();
    
    public function getMessage();
    
}