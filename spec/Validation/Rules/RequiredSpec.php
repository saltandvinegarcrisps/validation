<?php

namespace spec\Validation\Rules;

use PhpSpec\ObjectBehavior;

class RequiredSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Validation\Rules\Required');
    }

    public function it_should_validate_none_empty_strings()
    {
        $this->withValue('win')->isValid()->shouldBeEqualTo(true);
    }

    public function it_should_not_validate_empty_strings()
    {
        $this->withValue('')->isValid()->shouldBeEqualTo(false);
    }

    public function it_should_return_a_message()
    {
        $this->getMessage()->shouldBeString();
    }
}
