<?php declare(strict_types=1);

namespace spec\Validation;

use PhpSpec\ObjectBehavior;

class ViolationsSpec extends ObjectBehavior
{
    public function it_should_add_violations()
    {
        $this->add('foo', [new \Validation\Assert\Present]);
        $this->count()->shouldEqual(1);
    }

    public function it_should_return_a_message_line()
    {
        $this->add('foo_bar.baz', [new \Validation\Assert\Present]);
        $this->getMessagesLine()->shouldEqual('foo bar baz must be present');
    }
}
