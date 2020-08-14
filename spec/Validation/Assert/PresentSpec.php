<?php declare(strict_types=1);

namespace spec\Validation\Assert;

use PhpSpec\ObjectBehavior;

class PresentSpec extends ObjectBehavior
{
    public function it_should_validate()
    {
        $this->isValid('test')->shouldReturn(true);
        $this->isValid(null)->shouldReturn(false);
    }
}
