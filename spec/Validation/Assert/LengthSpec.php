<?php declare(strict_types=1);

namespace spec\Validation\Assert;

use PhpSpec\ObjectBehavior;

class LengthSpec extends ObjectBehavior
{
    public function it_should_validate_strings_of_correct_length()
    {
        $this->beConstructedWith(['min' => 4, 'max' => 4]);
        $this->isValid('test')->shouldReturn(true);
    }

    public function it_should_not_validate_short_strings()
    {
        $this->beConstructedWith(['min' => 5]);
        $this->isValid('fail')->shouldReturn(false);
    }

    public function it_should_not_validate_long_strings()
    {
        $this->beConstructedWith(['max' => 1]);
        $this->isValid('fail')->shouldReturn(false);
    }

    public function it_should_not_validate_nulls()
    {
        $this->isValid(null)->shouldReturn(false);
    }
}
