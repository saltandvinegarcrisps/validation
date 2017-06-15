<?php

namespace spec\Validation\Assert;

use PhpSpec\ObjectBehavior;

class NumericSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Validation\Assert\Numeric');
    }

    public function it_should_validate_number()
    {
        $this->isValid(1)->shouldReturn(true);
    }

    public function it_should_validate_signed_number()
    {
        $this->isValid(-1)->shouldReturn(true);
    }

    public function it_should_validate_plus_signed_number()
    {
        $this->isValid(+1)->shouldReturn(true);
    }

    public function it_should_validate_decimal_numbers()
    {
        $this->isValid(1.1)->shouldReturn(true);
    }

    public function it_should_validate_string_number()
    {
        $this->isValid('1')->shouldReturn(true);
    }

    public function it_should_validate_signed_string_number()
    {
        $this->isValid('-1')->shouldReturn(true);
    }

    public function it_should_validate_plus_signed_string_number()
    {
        $this->isValid('+1')->shouldReturn(true);
    }

    public function it_should_validate_decimal_string_numbers()
    {
        $this->isValid('1.1')->shouldReturn(true);
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
