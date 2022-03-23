<?php declare(strict_types=1);

namespace spec\Validation\Assert;

use PhpSpec\ObjectBehavior;
use Validation\Contracts\Constraint;

class ContainsSpec extends ObjectBehavior
{
    public function it_should_validate_array(Constraint $constraint)
    {
        $constraint->isValid('test')->shouldBeCalled()->willReturn(true);
        $this->beConstructedWith($constraint);
        $this->isValid(['test'])->shouldReturn(true);
    }

    public function it_should_validate_empty_array(Constraint $constraint)
    {
        $this->beConstructedWith($constraint);
        $this->isValid([])->shouldReturn(false);
        $this->getMessage('foo')->shouldReturn('foo must be an array');
    }

    public function it_should_validate_none_array(Constraint $constraint)
    {
        $this->beConstructedWith($constraint);
        $this->isValid('bar')->shouldReturn(false);
        $this->getMessage('foo')->shouldReturn('foo must be an array');
    }
}
