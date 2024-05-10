<?php

namespace App\Service;

use App\Contruct\CurrencyInterface;

class BDT implements CurrencyInterface{
    public string $currency;
    public function setCurrent($currency = "BDT"){
        $this->currency = $currency;
    }
    public function getCurrency(){
        return $this->currency;
    }
}
