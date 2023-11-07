<?php

namespace Omnipay\PayPlanet\Message;

class Methods {
    const PAYOUT_PAYPALANET = 1;
    const PAYMENT_PAYPLANET = 2;
    const PAYOUT_BRAZIL_PIX = 3;
    const PAYMENT_BRAZIL_PIX = 4;
    const PAYMENT_BRAZIL_PICPAY = 5;
    const PAYMENT_INDIA_NETBANKINGQP = 6;
    const PAYMENT_INDIA_PAYTMQP = 7;
    const PAYMENT_INDIA_UPIQP = 8;
    const PAYMENT_INDIA_PHONEPEQP = 9;
    const PAYMENT_INDIA_EPPZC = 10;
    const PAYMENT_DIRECTTRANSFER = 11;
    const PAYOUT_INDIA_IMPSQP = 12;
    const PAYOUT_INDIA_UPIQP = 13;
    const PAYOUT_INDIA_EP = 14;
    const PAYOUT_INDIA_IMPSPZC = 15;
    const PAYOUT_UZBEKISTAN = 16;
    const PAYMENT_UZBEKISTAN = 17;
    const PAYOUT_KAZAKHSTAN = 18;
    const PAYMENT_KAZAKHSTAN = 19;
    const PAYOUT_BANGLADESH_WALLET = 20;
    const PAYMENT_BANGLADESH = 21;
    const PAYMENT_BANGLADESH_WALLET = 22;
    const PAYOUT_ASIA_INDONESIA = 23;
    const PAYMENT_ASIA_INDONESIA = 24;
    const PAYOUT_ASIA_THAILAND = 25;
    const PAYMENT_ASIA_THAILAND = 26;
    const PAYOUT_COLOMBIA_TRANSFIYA = 27;
    const PAYMENT_COLOMBIA_PSE = 28;

    private static $methods = [
        self::PAYOUT_PAYPALANET => 'https://api.pay-planet.com/api/v1/paymentgate/payment/simple/',
        self::PAYMENT_PAYPLANET => 'https://api.pay-planet.com/api/v1/paymentgate/payment/simple/',

        self::PAYOUT_BRAZIL_PIX => 'https://api.pay-planet.com/api/v1/paymentgate/payout/pix/',
        self::PAYMENT_BRAZIL_PIX => 'https://api.pay-planet.com/api/v1/paymentgate/payment/pix/',
        self::PAYMENT_BRAZIL_PICPAY => 'https://api.pay-planet.com/api/v1/paymentgate/payment/picpay/',
        self::PAYMENT_INDIA_NETBANKINGQP => 'https://api.pay-planet.com/api/v2/india/paymentgate/payment/india_v2/netbanking_qp/',
        self::PAYMENT_INDIA_PAYTMQP => 'https://api.pay-planet.com/api/v2/india/paymentgate/payment/india_v2/paytm_qp_v2/',
        self::PAYMENT_INDIA_UPIQP => 'https://api.pay-planet.com/api/v2/india/paymentgate/payment/india_v2/upi_qp_v2/',
        self::PAYMENT_INDIA_PHONEPEQP => 'https://api.pay-planet.com/api/v2/india/paymentgate/payment/india_v2/phonepe_qp/',
        self::PAYMENT_INDIA_EPPZC => 'https://api.pay-planet.com/api/v2/india/paymentgate/payment/india_v2/ep_pzc/',
        self::PAYMENT_DIRECTTRANSFER => 'https://api.pay-planet.com/api/v2/india/paymentgate/payment/india_v2/direct_transfer/',

        self::PAYOUT_INDIA_IMPSQP => 'https://api.pay-planet.com/api/v2/india/paymentgate/payout/india_v2/imps_qp/',
        self::PAYOUT_INDIA_UPIQP => 'https://api.pay-planet.com/api/v2/india/paymentgate/payout/india_v2/upi_qp_v2/',
        self::PAYOUT_INDIA_EP => 'https://api.pay-planet.com/api/v2/india/paymentgate/payout/india_v2/ep/',
        self::PAYOUT_INDIA_IMPSPZC => 'https://api.pay-planet.com/api/v2/india/paymentgate/payout/india_v2/imps_pzc/',

        self::PAYOUT_UZBEKISTAN => 'https://api.pay-planet.com/api/v1/paymentgate/payout/simple/',
        self::PAYMENT_UZBEKISTAN => 'https://api.pay-planet.com/api/v1/paymentgate/payment/simple/',

        self::PAYOUT_KAZAKHSTAN => 'https://api.pay-planet.com/api/v2/kazakhstan/paymentgate/payout/simple/',
        self::PAYMENT_KAZAKHSTAN => 'https://api.pay-planet.com/api/v2/kazakhstan/paymentgate/payment/simple/',

        self::PAYOUT_BANGLADESH_WALLET => 'https://api.pay-planet.com/api/v2/bangladesh/paymentgate/payout/simple/',
        self::PAYMENT_BANGLADESH => 'https://api.pay-planet.com/api/v2/bangladesh/paymentgate/payment/simple/',
        self::PAYMENT_BANGLADESH_WALLET => 'https://api.pay-planet.com/api/v2/bangladesh/paymentgate/payment/simple/',

        self::PAYOUT_ASIA_INDONESIA => 'https://api.pay-planet.com/api/v2/asia/paymentgate/payout/indonesia_v1/simple/',
        self::PAYMENT_ASIA_INDONESIA => 'https://api.pay-planet.com/api/v2/asia/paymentgate/payment/indonesia_v1/create/',

        self::PAYOUT_ASIA_THAILAND => 'https://api.pay-planet.com/api/v2/asia/paymentgate/payout/thailand_v1/simple/',
        self::PAYMENT_ASIA_THAILAND => 'https://api.pay-planet.com/api/v2/asia/paymentgate/payment/thailand_v1/create/',

        self::PAYOUT_COLOMBIA_TRANSFIYA => 'https://api.pay-planet.com/api/v2/colombia/paymentgate/payout/transfiya/',
        self::PAYMENT_COLOMBIA_PSE => 'https://api.pay-planet.com/api/v2/colombia/paymentgate/payment/pse/',
    ];

    public static function getLink($methodId) {
        if (isset(self::$methods[$methodId])) {
            return self::$methods[$methodId];
        } else {
            throw new Exception('Unknown method ID');
        }
    }
}