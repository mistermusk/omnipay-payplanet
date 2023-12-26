<?php

namespace Omnipay\PayPlanet;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'PayPlanet';
    }

    private $keys = [];
    public function setKeys($apiData)
    {
        $this->keys = $apiData;
    }

    public function getKeys()
    {
        return $this->keys;
    }

    public function formatLevel($level){
        if ($level){
            return 'first_level';
        }
        return 'second_level';
    }


    public function isSignatureValidDeposit($sign, $data, $level, $method, $currency){

        $sign = (string) $sign;
        $secretKey = (string) $this->getKeys()['api_deposit'][$this->formatLevel($level)][$method][$currency]['secret_key'];
        $jsonData = json_encode($data);
        $computedSign = hash('sha256', $secretKey . $jsonData);
        return $sign === $computedSign;
    }

    public function isSignatureValidWithdrawal($sign, $data, $method, $currency){

        $sign = (string) $sign;
        $secretKey = (string) $this->getKeys()['api_deposit'][$method][$currency]['secret_key'];
        $jsonData = json_encode($data);
        $computedSign = hash('sha256', $secretKey . $jsonData);
        return $sign === $computedSign;
    }


    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\PayPlanet\Message\PurchaseRequest', $parameters)
            ->setKeys($this->getKeys());
    }

    public function payout(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\PayPlanet\Message\PayoutRequest', $parameters)
            ->setKeys($this->getKeys());
    }

    public function moderated(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\PayPlanet\Message\ModeratePayoutRequest', $parameters)
            ->setKeys($this->getKeys());
    }


}
