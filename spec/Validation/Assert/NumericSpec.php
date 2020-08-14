<?php declare(strict_types=1);

namespace spec\Validation\Assert;

use PhpSpec\ObjectBehavior;

class NumericSpec extends ObjectBehavior
{
    public function it_should_validate_number()
    {
        $this->isValid('1')->shouldReturn(true);
    }

    public function it_should_not_validate_with_a_min_number()
    {
        $this->beConstructedWith(['min' => 2]);
        $this->isValid('1')->shouldReturn(false);
    }

    public function it_should_validate_with_a_min_number()
    {
        $this->beConstructedWith(['min' => 2]);
        $this->isValid('3')->shouldReturn(true);
    }

    public function it_should_not_validate_with_a_max_number()
    {
        $this->beConstructedWith(['max' => 2]);
        $this->isValid('3')->shouldReturn(false);
    }

    public function it_should_validate_with_a_max_number()
    {
        $this->beConstructedWith(['max' => 2]);
        $this->isValid('1')->shouldReturn(true);
    }

    public function it_should_validate_signed_number()
    {
        $this->isValid('-1')->shouldReturn(true);
    }

    public function it_should_validate_plus_signed_number()
    {
        $this->isValid('+1')->shouldReturn(true);
    }

    public function it_should_validate_decimal_numbers()
    {
        $this->isValid('1.1')->shouldReturn(true);
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

    public function it_should_not_validate_nulls()
    {
        $this->isValid(null)->shouldReturn(false);
    }
}
