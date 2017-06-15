<?php

namespace spec\Validation;

use PhpSpec\ObjectBehavior;

class ArrayValidatorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Validation\ArrayValidator');
    }

    public function it_should_add_constraints()
    {
        $this->addConstraint('foo', new \Validation\Assert\Present);
        $this->getConstraints()->shouldHaveKey('foo');
    }

    public function it_should_add_many_constraints()
    {
        $this->addConstraints('foo', [new \Validation\Assert\Present]);
        $this->getConstraints()->shouldHaveKey('foo');
    }

    public function it_should_return_violations()
    {
        $this->validate(['foo' => 'bar'])->shouldReturnAnInstanceOf(\Validation\Violations::class);
    }

    public function it_should_return_validate_nested()
    {
        $payload = [
            'foo' => [
                'bar' => 'baz',
            ],
        ];

        $this->addConstraints('foo.bar', [new \Validation\Assert\Present]);
        $this->validate($payload)->count()->shouldReturn(0);
    }
}
