<?php

namespace App\Dtos;

class Integer extends Result
{
    public function getValue(): int
    {
        return (int) $this->value;
    }
}