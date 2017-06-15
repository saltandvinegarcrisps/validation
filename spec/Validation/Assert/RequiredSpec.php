<?php

namespace spec\Validation\Assert;

use PhpSpec\ObjectBehavior;

class RequiredSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Validation\Assert\Required');
    }

    public function it_should_validate_none_empty()
    {
        $this->isValid('1')->shouldReturn(true);
    }

    public function it_should_validate_numbers()
    {
        $this->isValid(1.1)->shouldReturn(true);
    }

    public function it_should_validate_empty_arrays()
    {
        $this->isValid([])->shouldReturn(false);
    }

    public function it_should_validate_arrays()
    {
        $this->isValid(['test'])->shouldReturn(true);
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
