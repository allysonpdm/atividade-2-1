<?php

namespace App\Dtos;

class Roman extends Result
{
    public function getValue(): string
    {
        return (string) $this->value;
    }
}