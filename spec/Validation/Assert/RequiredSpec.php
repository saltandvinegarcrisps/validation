<?php declare(strict_types=1);

namespace spec\Validation\Assert;

use PhpSpec\ObjectBehavior;

class RequiredSpec extends ObjectBehavior
{
    public function it_should_validate_none_empty()
    {
        $this->isValid('1')->shouldReturn(true);
    }

    public function it_should_not_validate_nulls()
    {
        $this->isValid(null)->shouldReturn(false);
    }
}
