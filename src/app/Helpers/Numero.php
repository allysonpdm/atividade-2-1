<?php

namespace App\Helpers;
use App\Enum\Romanos;

final class Numero
{
    /**
     * Para cifras elevadas, utiliza-se um travessão por cima da letra, que representa sua multiplicação por 1000.
     * Assim, C corresponde ao valor 100 000 (100 x 1 000) e M corresponde ao valor 1 000 000 (1 000 x 1 000).
     * Desta forma, o maior número que podemos escrever é 3 999 000, que corresponde a MMMCMXCIX.
     * Vale lembrar que esse sistema não permite escrever números superiores a 3 999 que não terminem em 000.
     * fonte: https://pt.wikipedia.org/wiki/Numera%C3%A7%C3%A3o_romana
     */
    public const LIMITE_MINIMO = 1;
    public const LIMITE_MAXIMO = 3999000;

    public static function integerToRoman(int $inteiro): string
    {
        if ($inteiro < static::LIMITE_MINIMO || $inteiro > static::LIMITE_MAXIMO) {
            throw new \InvalidArgumentException("Número fora do intervalo suportado (1 a 3.999.000).");
        }

        if ($inteiro > 3999 && $inteiro % 1000 !== 0) {
            throw new \InvalidArgumentException("O sistema romano não permite escrever números superiores a 3.999 que não terminem em 000.");
        }

        $valores = Romanos::cases();

        $saida = '';

        foreach ($valores as $enum) {
            while ($inteiro >= $enum->value) {
                $saida .= $enum->name;
                $inteiro -= $enum->value;
            }
        }

        return mb_convert_encoding($saida, 'UTF-8', 'auto');
    }

    public static function romanToInteger(string $romano): int
    {

        $romano = mb_convert_encoding($romano, 'UTF-8', 'auto');
        $valores = Romanos::toMap();
        $inteiro = 0;
        $i = 0;
        $len = mb_strlen($romano);

        while ($i < $len) {
            if ($i <= $len - 4) {
                $numero = mb_substr($romano, $i, 4);
                if (isset($valores[$numero])) {
                    $inteiro += $valores[$numero];
                    $i += 4;
                    continue;
                }
            }

            if ($i <= $len - 2) {
                $numero = mb_substr($romano, $i, 2);
                if (isset($valores[$numero])) {
                    $inteiro += $valores[$numero];
                    $i += 2;
                    continue;
                }
            }

            $numero = mb_substr($romano, $i, 1);
            if (isset($valores[$numero])) {
                $inteiro += $valores[$numero];
                $i += 1;
                continue;
            }

            $posicao = $i + 1;
            throw new \InvalidArgumentException("O caractere romano '$numero', na posição $posicao, é inválido.");
        }

        if($inteiro > 3999 && $inteiro % 1000 !== 0) {
            throw new \InvalidArgumentException("O sistema romano não permite escrever números superiores a 3.999 que não terminem em 000.");
        }

        return $inteiro;
    }
}