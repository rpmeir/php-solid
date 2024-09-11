<?php

namespace Src\Dip;

class Email {
    private string $value;

    public function __construct(public readonly string $email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email');
        }
        $this->value = $email;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
