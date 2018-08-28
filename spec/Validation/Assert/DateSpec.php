<?php

namespace spec\Validation\Assert;

use PhpSpec\ObjectBehavior;

class DateSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Validation\Assert\Date');
    }

    public function it_should_validate_date()
    {
        $this->beConstructedWith(['format' => 'Y-m-d']);
        $this->isValid('2016-01-01')->shouldReturn(true);
        $this->isValid('0000-00-00')->shouldReturn(false);
        $this->isValid('1782-01-01')->shouldReturn(true);
        $this->isValid('2018-02-31')->shouldReturn(false);
    }

    public function it_should_not_validate_string()
    {
        $this->isValid('not a date')->shouldReturn(false);
    }

    public function it_should_not_validate_numbers()
    {
        $this->isValid(1.1)->shouldReturn(false);
    }

    public function it_should_not_validate_arrays()
    {
        $this->isValid([])->shouldReturn(false);
    }

    public function it_should_not_validate_objects()
    {
        $this->isValid(new \StdClass)->shouldReturn(false);
    }

    public function it_should_not_validate_nulls()
    {
        $this->isValid(null)->shouldReturn(false);
    }
}
