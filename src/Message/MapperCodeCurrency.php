<?php

namespace Omnipay\PayPlanet\Message;

use Alcohol\ISO4217;

class MapperCodeCurrency
{
    public static function convertCurrencyNameToCode($currencyName)
    {
        $iso4217 = new ISO4217();

        $currency = $iso4217->getByAlpha3($currencyName);

        return $currency ? $currency['numeric'] : null;
    }
}
