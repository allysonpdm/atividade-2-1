<?php

namespace App\Dtos;

abstract class Result
{
    public function __construct(public mixed $value)
    {
        
    }

    abstract public function getValue();
}