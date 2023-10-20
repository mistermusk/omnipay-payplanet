<?php

namespace Omnipay\PayPlanet\Message;


class MapperCodeCurrency
{
    protected static $currencyMapper = array(
        978 => "EUR",
        "EUR" => 978,
    );

    public static function convertCurrencyCodeToName(int $code)
    {
        return self::$currencyMapper[$code] ?? null;
    }

    public static function convertCurrencyNameToCode(string $name)
    {
        return self::$currencyMapper[$name] ?? null;
    }
}
