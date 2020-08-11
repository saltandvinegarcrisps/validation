<?php declare(strict_types=1);


namespace Validation\Contracts;


interface CallbackValidator
{
    public function setMessage(string $message): self;

    public function getMessage(): string;
}
