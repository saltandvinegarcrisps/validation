<?php

namespace spec\Validation\Assert;

use PhpSpec\ObjectBehavior;

class PresentSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Validation\Assert\Present');
    }

    public function it_should_validate_strings()
    {
        $this->isValid('1')->shouldReturn(true);
    }

    public function it_should_validate_numbers()
    {
        $this->isValid(1.1)->shouldReturn(true);
    }

    public function it_should_validate_arrays()
    {
        $this->isValid([])->shouldReturn(true);
    }

    public function it_should_validate_objects()
    {
        $this->isValid(new \StdClass)->shouldReturn(true);
    }

    public function it_should_not_validate_nulls()
    {
        $this->isValid(null)->shouldReturn(false);
    }
}
