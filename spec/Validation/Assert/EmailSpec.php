<?php declare(strict_types=1);

namespace spec\Validation\Assert;

use PhpSpec\ObjectBehavior;

class EmailSpec extends ObjectBehavior
{
    public function it_should_validate_emails()
    {
        $this->isValid('test@test.com')->shouldReturn(true);
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
