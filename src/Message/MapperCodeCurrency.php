<?php

namespace Omnipay\PayPlanet\Message;


class MapperCodeCurrency
{
    public static function convertCurrencyNameToCode($currencyName)
    {
        $iso4217 = new Alcohol\ISO4217();

        $currency = $iso4217->getByAlphabeticCode($currencyName);

        return $currency ? $currency->getNumeric() : null;
    }
}
