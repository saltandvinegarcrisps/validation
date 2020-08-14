<?php declare(strict_types=1);

namespace spec\Validation;

use PhpSpec\ObjectBehavior;
use Validation\Contracts\CallbackValidator;

class ArrayValidatorSpec extends ObjectBehavior
{
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

    public function it_should_validate_closure()
    {
        $payload = [
            'foo' => 'bar',
        ];

        $this->addConstraint('foo', function (string $value, CallbackValidator $failure) {
            if (!is_int($value)) {
                return $failure->setMessage('bang');
            }
        });

        $violations = $this->validate($payload);
        $violations->count()->shouldReturn(1);
        $violations->getMessagesLine()->shouldReturn('bang');
    }

    public function it_should_validate_closure_but_passes_with_no_callback_validator_returned()
    {
        $payload = [
            'foo' => 'bar',
        ];

        $this->addConstraint('foo', function (string $value, CallbackValidator $failure) {
            if (is_string($value)) {
                return;
            }

            return $failure->setMessage('foo is not a string');
        });

        $this->validate($payload)->count()->shouldReturn(0);
    }
}
