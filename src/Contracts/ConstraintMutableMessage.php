<?php declare(strict_types=1);

namespace Validation\Contracts;

interface ConstraintMutableMessage extends ConstraintMessage
{
    public function setMessage(string $message): self;
}
