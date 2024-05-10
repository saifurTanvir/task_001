<?php

namespace App\Service;

use App\Contruct\CurrencyInterface;

class Dollar implements CurrencyInterface{
    public string $currency;
    public function setCurrent($currency = "Dollar"){
        $this->currency = $currency;
    }
    public function getCurrency(){
        return $this->currency;
    }
}
