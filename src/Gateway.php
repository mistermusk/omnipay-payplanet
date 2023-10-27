<?php

namespace Omnipay\PayPlanet;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'PayPlanet';
    }

    public function getDefaultParameters()
    {
        return [
            'apiKey' => '',
            'secretKey' => '',
        ];
    }

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
    }

    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\PayPlanet\Message\PurchaseRequest', $parameters)
            ->setEndpoint($this->getApiKey())
            ->setSecretKey($this->getSecretKey());
    }

    public function payout(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\PayPlanet\Message\PayoutRequest', $parameters)
            ->setEndpoint($this->getApiKey())
            ->setSecretKey($this->getSecretKey());
    }

    public function moderated(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\PayPlanet\Message\ModeratePayoutRequest', $parameters)
            ->setEndpoint($this->getApiKey())
            ->setSecretKey($this->getSecretKey());
    }

    public function fetchTransaction(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\PayPlanet\Message\FetchTransactionRequest', $parameters)
            ->setEndpoint($this->getApiKey())
            ->setSecretKey($this->getSecretKey());
    }

    public function fetchPayout(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\PayPlanet\Message\PayoutInfoRequest', $parameters)
            ->setEndpoint($this->getApiKey())
            ->setSecretKey($this->getSecretKey());
    }



}
