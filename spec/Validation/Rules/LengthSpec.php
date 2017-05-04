<?php

namespace spec\Validation\Rules;

use PhpSpec\ObjectBehavior;

class LengthSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Validation\Rules\Length');
    }

    public function it_should_validate_string_in_range()
    {
        $this->withRange(0, 20)->withValue('under 20 characters')->isValid()->shouldBeEqualTo(true);
    }

    public function it_should_not_validate_string_out_of_range()
    {
        $this->withRange(4)->withValue('one')->isValid()->shouldBeEqualTo(false);

        $this->withRange(0, 1)->withValue('two')->isValid()->shouldBeEqualTo(false);
    }

    public function it_should_return_a_message()
    {
        $this->getMessage()->shouldBeString();
    }
}
