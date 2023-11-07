<?php

namespace Omnipay\PayPlanet\Message;
use Alcohol\ISO4217;
use Illuminate\Support\Facades\Log;

class MapperCodeCurrency
{


    public static function convertCurrencyCodeToName(int $code)
    {
        $iso4217 = new ISO4217;
        return $iso4217->getByNumeric("$code").getName();
    }

    public static function convertCurrencyNameToCode(string $name)
    {
        $iso4217 = new ISO4217;
        return $iso4217->getByAlpha3($name).getNumeric();

    }
}

