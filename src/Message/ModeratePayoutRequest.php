<?php

namespace Omnipay\PayPlanet\Message;

use Omnipay\Common\Message\AbstractRequest;

class ModeratePayoutRequest extends AbstractRequest
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


    public function getModerated()
    {
        return $this->getParameter('moderated');
    }

    public function setModerated($value)
    {
        return $this->setParameter('moderated', $value);
    }


    public function getTx()
    {
        return $this->getParameter('tx');
    }

    public function setTx($value)
    {
        return $this->setParameter('tx', $value);
    }
    public function getData()
    {
        $this->validate('amount', 'currency');

        $data = [
            'endpoint' => $this->getEndpoint(),
            "moderated" => $this->getModerated(),
            'tx' => $this->getTx()
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
        return $this->response = new ModeratePayoutResponse($this, json_decode($data, true));
    }

    protected function getPayoutApiEndpoint()
    {
        return 'https://api.pay-planet.com/api/v1/paymentgate/payout/simple/';
    }
}
