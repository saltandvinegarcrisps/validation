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
}
