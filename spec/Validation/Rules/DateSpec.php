<?php

namespace spec\Validation\Rules;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DateSpec extends ObjectBehavior {

	public function it_is_initializable() {
		$this->shouldHaveType('Validation\Rules\Date');
	}

	public function it_should_validate_time_stamps() {
		$this->withValue('1436520997')->isValid()->shouldBeEqualTo(true);
	}

	public function it_should_validate_string_dates() {
		$this->withValue('23rd April 2000')->isValid()->shouldBeEqualTo(true);
	}

	public function it_should_not_validate_incorrect_dates() {
		$this->withValue('some random string')->isValid()->shouldBeEqualTo(false);
	}

	public function it_should_return_a_message() {
		$this->getMessage()->shouldBeString();
	}

}
