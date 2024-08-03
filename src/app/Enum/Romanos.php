<?php

namespace App\Enum;

enum Romanos: int
{
    case M̅ = 1000000;
    case C̅M̅ = 900000;
    case D̅ = 500000;
    case C̅D̅ = 400000;
    case C̅ = 100000;
    case X̅C̅ = 90000;
    case L̅ = 50000;
    case X̅L̅ = 40000;
    case X̅ = 10000;
    case I̅X̅ = 9000;
    case V̅ = 5000;
    case I̅V̅ = 4000;
    case M = 1000;
    case CM = 900;
    case D = 500;
    case CD = 400;
    case C = 100;
    case XC = 90;
    case L = 50;
    case XL = 40;
    case X = 10;
    case IX = 9;
    case V = 5;
    case IV = 4;
    case I = 1;

    public static function toMap(): array
    {
        $map = [];
        foreach (self::cases() as $case) {
            $map[$case->name] = (int) $case->value;
        }
        return $map;
    }
}
