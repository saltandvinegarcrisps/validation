<?php declare(strict_types=1);

namespace spec\Validation\Assert;

use PhpSpec\ObjectBehavior;

class EnumSpec extends ObjectBehavior
{
    public function it_should_validate_enums()
    {
        $this->beConstructedWith(['a', 'b', 'c']);
        $this->isValid('a')->shouldReturn(true);
        $this->isValid('b')->shouldReturn(true);
        $this->isValid('c')->shouldReturn(true);
        $this->isValid('d')->shouldReturn(false);
    }
}
