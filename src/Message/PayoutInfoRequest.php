<?php

namespace Omnipay\PayPlanet\Message;

use Omnipay\Common\Message\AbstractRequest;

class PayoutInfoRequest extends AbstractRequest
{
    public function getEndpoint()
    {
        return $this->getParameter('endpoint');
    }

    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
    }


    public function setEndpoint($value)
    {
        return $this->setParameter('endpoint', $value);
    }

    public function getTransactionId()
    {
        return $this->getParameter('tx');
    }

    public function setTransactionId($value)
    {
        return $this->setParameter('tx', $value);
    }

    public function getData()
    {
        $this->validate('endpoint', 'tx');

        return [
            'endpoint' => $this->getEndpoint(),
            'tx' => $this->getTransactionId(),
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
        return $this->response = new PayoutInfoResponse($this, json_decode($data, true));
    }

    protected function getApiEndpoint()
    {
        return 'https://api.pay-planet.com/api/v1/paymentgate/payout/info/';
    }
}
