<?php

namespace spec\Validation\Rules;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AlnumSpec extends ObjectBehavior {

	public function it_is_initializable() {
		$this->shouldHaveType('Validation\Rules\Alnum');
	}

	public function it_should_validate_numbers_or_letters_only() {
		$this->withValue('abc123')->isValid()->shouldBeEqualTo(true);

		$this->withValue('!"£$%^&*()_+')->isValid()->shouldBeEqualTo(false);
	}

	public function it_should_return_a_message() {
		$this->getMessage()->shouldBeString();
	}

}
