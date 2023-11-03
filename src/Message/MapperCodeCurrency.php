<?php

namespace Omnipay\PayPlanet\Message;
use \Payum\ISO4217\ISO4217;

class MapperCodeCurrency
{


    public static function convertCurrencyCodeToName(int $code)
    {
        $iso4217 = new ISO4217;
        return $iso4217->findByNumeric("$code").getName();
    }

    public static function convertCurrencyNameToCode(string $name)
    {
        $iso4217 = new ISO4217;
        return $iso4217->findByAlpha3($name).getNumeric();
    }
}

