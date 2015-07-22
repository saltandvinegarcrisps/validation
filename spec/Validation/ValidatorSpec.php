<?php

namespace spec\Validation;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ValidatorSpec extends ObjectBehavior {

	public function it_is_initializable() {
		$this->shouldHaveType('Validation\Validator');
	}

	public function it_can_be_constructed_with_values() {
		$this->beConstructedWith(['foo' => 'bar']);
		$this->getValues()->shouldHaveKeyWithValue('foo', 'bar');
	}

	public function it_should_add_messages() {
		$this->addMessage('baz');
		$this->getMessages()->shouldContain('baz');
	}

	public function it_can_be_set_as_invalid() {
		$this->setInvalid('baz');
		$this->isValid()->shouldBeEqualTo(false);
	}

	public function it_should_add_new_rules() {
		$this->beConstructedWith(['foo' => 'bar']);

		$rule = new \Validation\Rules\Date;

		$this->addRule($rule, 'foo');

		$this->getRules()->shouldHaveKeyWithValue('foo', [$rule]);
	}

	public function it_should_validate_rules() {
		$this->beConstructedWith(['foo' => 'bar']);

		$this->addRule(new \Validation\Rules\Required, 'foo');

		$this->countExecutedRules()->shouldBeEqualTo(0);

		$this->isValid();

		$this->countExecutedRules()->shouldBeEqualTo(1);

		$this->isValid();

		$this->countExecutedRules()->shouldBeEqualTo(1);
	}

	public function it_should_validate_custom_rules() {
		$this->beConstructedWith(['foo' => 'bar']);

		$this->addRule(function($value) { return [$value === '', 'message']; }, 'foo');

		$this->countExecutedRules()->shouldBeEqualTo(0);

		$this->isValid();

		$this->countExecutedRules()->shouldBeEqualTo(1);

		$this->isValid();

		$this->countExecutedRules()->shouldBeEqualTo(1);
	}

}
