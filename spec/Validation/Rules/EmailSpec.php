<?php

namespace spec\Validation\Rules;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EmailSpec extends ObjectBehavior
{

    public function it_is_initializable()
    {
        $this->shouldHaveType('Validation\Rules\Email');
    }

    public function it_should_validate_well_formatted_emails()
    {
        $this->withValue('hello@world.me')->isValid()->shouldBeEqualTo(true);
    }

    public function it_should_not_validate_none_emails()
    {
        $this->withValue('hello@world')->isValid()->shouldBeEqualTo(false);
    }

    public function it_should_return_a_message()
    {
        $this->getMessage()->shouldBeString();
    }
}
