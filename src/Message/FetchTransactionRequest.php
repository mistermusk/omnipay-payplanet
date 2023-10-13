<?php

namespace Omnipay\PayPlanet\Message;

use Omnipay\Common\Message\AbstractRequest;

class FetchTransactionRequest extends AbstractRequest
{
    public function getTransactionReference()
    {
        return $this->getParameter('transactionReference');
    }

    public function setTransactionReference($value)
    {
        return $this->setParameter('transactionReference', $value);
    }

    public function getEndpoint()
    {
        return $this->getParameter('endpoint');
    }

    public function setEndpoint($value)
    {
        return $this->setParameter('endpoint', $value);
    }

    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
    }

    public function getData()
    {
        $this->validate('transactionReference', 'endpoint');

        return [
            'endpoint' => $this->getEndpoint(),
            'tx' => $this->getTransactionReference(),
        ];
    }

    public function sendData($data)
    {
        $secretKey = $this->getSecretKey();
        $jsonData = json_encode($data);
        $headers = [
            'Content-Type' => 'application/json',
            'API-Sign' => hash('sha256', $secretKey . $jsonData)
        ];

        $httpResponse = $this->httpClient->request('GET', $this->getApiEndpoint(), $headers, $jsonData);
        return $this->createResponse($httpResponse->getBody()->getContents());
    }

    protected function createResponse($data)
    {
        return new FetchTransactionResponse($this, json_decode($data, true));
    }

    protected function getApiEndpoint()
    {
        return 'https://api.pay-planet.com/api/v1/paymentgate/payment/info/';
    }
}
