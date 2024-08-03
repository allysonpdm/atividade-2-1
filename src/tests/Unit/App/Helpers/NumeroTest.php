<?php

namespace Tests\App\Helpers;

use App\Helpers\Numero;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class NumeroTest extends TestCase
{
    public function testIntegerToRoman()
    {
        $this->assertEquals('I', Numero::integerToRoman(1));
        $this->assertEquals('IV', Numero::integerToRoman(4));
        $this->assertEquals('IX', Numero::integerToRoman(9));
        $this->assertEquals('X', Numero::integerToRoman(10));
        $this->assertEquals('XL', Numero::integerToRoman(40));
        $this->assertEquals('XC', Numero::integerToRoman(90));
        $this->assertEquals('C', Numero::integerToRoman(100));
        $this->assertEquals('CD', Numero::integerToRoman(400));
        $this->assertEquals('D', Numero::integerToRoman(500));
        $this->assertEquals('CM', Numero::integerToRoman(900));
        $this->assertEquals('M', Numero::integerToRoman(1000));
        $this->assertEquals('MMMCMXCIX', Numero::integerToRoman(3999));
        $this->assertEquals('M̅', Numero::integerToRoman(1000000));
        $this->assertEquals('M̅C̅M̅X̅C̅I̅X̅', Numero::integerToRoman(1999000));
        $this->assertEquals('M̅M̅C̅M̅X̅C̅I̅X̅', Numero::integerToRoman(2999000));
    }

    public function testIntegerToRomanOutOfRange()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Número fora do intervalo suportado (1 a 3.999.000).");
        Numero::integerToRoman(0);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Número fora do intervalo suportado (1 a 3.999.000).");
        Numero::integerToRoman(4000000);
    }

    public function testIntegerToRomanInvalidThousands()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("O sistema romano não permite escrever números superiores a 3.999 que não terminem em 000.");
        Numero::integerToRoman(4001);
    }

    public function testRomanToInteger()
    {
        $this->assertEquals(1, Numero::romanToInteger('I'));
        $this->assertEquals(4, Numero::romanToInteger('IV'));
        $this->assertEquals(9, Numero::romanToInteger('IX'));
        $this->assertEquals(10, Numero::romanToInteger('X'));
        $this->assertEquals(40, Numero::romanToInteger('XL'));
        $this->assertEquals(90, Numero::romanToInteger('XC'));
        $this->assertEquals(100, Numero::romanToInteger('C'));
        $this->assertEquals(400, Numero::romanToInteger('CD'));
        $this->assertEquals(500, Numero::romanToInteger('D'));
        $this->assertEquals(900, Numero::romanToInteger('CM'));
        $this->assertEquals(1000, Numero::romanToInteger('M'));
        $this->assertEquals(3999, Numero::romanToInteger('MMMCMXCIX'));
        $this->assertEquals(1000000, Numero::romanToInteger('M̅'));
        $this->assertEquals(1999000, Numero::romanToInteger('M̅C̅M̅X̅C̅I̅X̅'));
        $this->assertEquals(2999000, Numero::romanToInteger('M̅M̅C̅M̅X̅C̅I̅X̅'));
    }

    public function testRomanToIntegerInvalidCharacters()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("O caractere romano 'A', na posição 1, é inválido.");
        Numero::romanToInteger('A');

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("O caractere romano 'IIII', na posição 1, é inválido.");
        Numero::romanToInteger('IIII');
    }

    public function testRomanToIntegerInvalidThousands()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("O sistema romano não permite escrever números superiores a 3.999 que não terminem em 000.");
        Numero::romanToInteger('MMMMI');
    }

    public function testRandomIntegerToRomanAndBack()
    {
        $numTests = 100;

        for ($i = 0; $i < $numTests; $i++) {
            $randomNumber = rand(1, 5000000);

            if($randomNumber > 3999 && $randomNumber % 1000 !== 0){
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage("O sistema romano não permite escrever números superiores a 3.999 que não terminem em 000.");
            }

            if($randomNumber > 3999000) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage("Número fora do intervalo suportado (1 a 3.999.000).");
            }

            $roman = Numero::integerToRoman($randomNumber);
            $convertedBackNumber = Numero::romanToInteger($roman);
            $this->assertEquals($randomNumber, $convertedBackNumber, "Falhou para o número inteiro: $randomNumber");
        }
    }
}
