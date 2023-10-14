<?php

namespace Omnipay\PayPlanet\Message;

use Omnipay\Common\Message\AbstractRequest;

class PayoutRequest extends AbstractRequest
{
    public function getEndpoint()
    {
        return $this->getParameter('endpoint');
    }

    public function setEndpoint($value)
    {
        return $this->setParameter('endpoint', $value);
    }

    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
    }

    public function getData()
    {
        $this->validate('amount', 'currency');

        $data = [
            'endpoint' => $this->getEndpoint(),
            'module' => $this->getModule(),
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency(),
            'description' => $this->getDescription(),
            'client_id' => $this->getClientId(),
        ];

        return array_filter($data, function ($value) {
            return $value !== null;
        });
    }

    public function sendData($data)
    {
        $secretKey = $this->getParameter('secretKey');
        $jsonData = json_encode($data);
  
        $headers = [
            'Content-Type' => 'application/json',
            'API-Sign' => hash('sha256', $secretKey . $jsonData)
        ];

        $httpResponse = $this->httpClient->request('POST', $this->getPayoutApiEndpoint(), $headers, $jsonData);

        return $this->createResponse($httpResponse->getBody()->getContents());
    }

    protected function createResponse($data)
    {
        return $this->response = new PayoutResponse($this, json_decode($data, true));
    }

    protected function getPayoutApiEndpoint()
    {
        return 'https://api.pay-planet.com/api/v1/paymentgate/payout/simple/';
    }
}
