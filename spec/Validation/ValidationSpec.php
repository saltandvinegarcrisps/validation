<?php

namespace spec\Validation;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ValidationSpec extends ObjectBehavior {

	public function it_is_initializable() {
		$this->shouldHaveType('Validation\Validation');
	}

	public function it_should_create_a_validator() {
		$this->create([], [])->shouldBeAnInstanceOf('\\Validation\\Validator');
	}

	public function it_should_create_a_validator_with_simple_options() {
		$v = $this->create(['foo' => 'bar'], ['foo' => ['required']]);
		$v->isValid();
		$v->countExecutedRules()->shouldBeEqualTo(1);
	}

	public function it_should_create_a_validator_with_extended_options() {
		$v = $this->create(['foo' => 'bar'], ['foo' => ['label' => 'Foo', 'rules' => ['required']]]);
		$v->isValid();
		$v->countExecutedRules()->shouldBeEqualTo(1);
	}

}
