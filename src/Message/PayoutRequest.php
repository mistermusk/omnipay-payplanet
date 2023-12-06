<?php

namespace Omnipay\PayPlanet\Message;

use Omnipay\Common\Message\AbstractRequest;
use MapperCodeCurrency;

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

    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    public function getCurrency()
    {
        return $this->getParameter('currency');
    }

    public function setCurrency($value)
    {
        return $this->setParameter('currency', $value);
    }

    public function getPan()
    {
        return $this->getParameter('pan');
    }

    public function setPan($value)
    {
        return $this->setParameter('pan', $value);
    }

    public function getModerated()
    {
        return $this->getParameter('moderated');
    }

    public function setModerated($value)
    {
        return $this->setParameter('moderated', $value);
    }
    public function setMethod($value)
    {
        return $this->setParameter('method', $value);
    }
    public function getMethod()
    {
        return $this->getParameter('method');
    }

    public function getData()
    {
        $this->validate('amount', 'currency');

        $data = [
            'endpoint' => $this->getEndpoint(),
            "pan" => $this->getPan(),
            'amount' => $this->getAmount(),
            'currency' => MapperCodeCurrency::convertCurrencyNameToCode($this->getCurrency()),
            'moderated' => $this->getModerated()
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
        $mth = $this->getMethod();
        settype($mth, "integer");
        return Methods::getLink($mth);
    }

}
