<?php declare(strict_types=1);

namespace spec\Validation\Assert;

use PhpSpec\ObjectBehavior;

class DateSpec extends ObjectBehavior
{
    public function it_should_validate_date()
    {
        $this->beConstructedWith(['format' => 'Y-m-d']);
        $this->isValid('2016-01-01')->shouldReturn(true);
    }

    public function it_should_validate_dates_in_the_past()
    {
        $this->beConstructedWith(['format' => 'Y-m-d']);
        $this->isValid('1567-03-11')->shouldReturn(true);
    }

    public function it_should_not_validate_incorrect_dates()
    {
        $this->beConstructedWith(['format' => 'Y-m-d']);
        $this->isValid('2018-02-31')->shouldReturn(false);
    }

    public function it_should_not_validate_zero_dates()
    {
        $this->beConstructedWith(['format' => 'Y-m-d']);
        $this->isValid('0000-00-00')->shouldReturn(false);
    }

    public function it_should_validate_zero_dates_when_specified()
    {
        $this->beConstructedWith(['format' => 'Y-m-d', 'allowZeros' => true]);
        $this->isValid('0000-00-00')->shouldReturn(true);
    }

    public function it_should_not_validate_string()
    {
        $this->isValid('not a date')->shouldReturn(false);
    }

    public function it_should_not_validate_numbers()
    {
        $this->isValid('1.1')->shouldReturn(false);
    }

    public function it_should_not_validate_nulls()
    {
        $this->isValid(null)->shouldReturn(false);
    }
}
