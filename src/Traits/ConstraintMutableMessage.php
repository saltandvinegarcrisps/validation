<?php declare(strict_types=1);

namespace Validation\Traits;

trait ConstraintMutableMessage
{
    use ConstraintMessage;

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
