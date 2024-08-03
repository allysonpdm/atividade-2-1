<?php

namespace App\Services;

use App\Dtos\Integer;
use App\Dtos\Result;
use App\Dtos\Roman;
use App\Helpers\Numero;

require 'vendor/autoload.php';

class Main
{

    public ?string $error = null;
    public ?string $romanResult;
    public ?string $integerResult;

    public function converter(): void
    {
        try{
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!empty($_POST['integer'])) {
                    $integer = (int) $_POST['integer'];
                    $this->romanResult = $this->parseString(new Roman(Numero::integerToRoman($integer)));
                }
    
                if (!empty($_POST['roman'])) {
                    $roman = $_POST['roman'];
                    $this->integerResult = $this->parseString(new Integer(Numero::romanToInteger($roman)));
                }
            }
        } catch (\InvalidArgumentException $e) {
            $this->error = $e->getMessage();
        }
    }

    protected function parseString(Result $result): string
    {
        return (string) $result->getValue();
    }
}
