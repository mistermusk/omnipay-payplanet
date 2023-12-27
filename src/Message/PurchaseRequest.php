<?php


namespace Omnipay\PayPlanet\Message;
use Omnipay\PayPlanet\Message\MapperCodeCurrency;
use Omnipay\Common\Message\AbstractRequest;

class PurchaseRequest extends AbstractRequest
{

    public function setKeys($fullKeys){
        return $this->setParameter('keys', $fullKeys);
    }

    public function getKeys()
    {
        return $this->getParameter('keys');
    }

    public function getApikey()
    {
        return $this->getKeys()['api_deposit'][$this->getLevel()][$this->getMethod()][$this->getCurrency()]['api_key'];
    }

    public function getSecretKey()
    {
        return $this->getKeys()['api_deposit'][$this->getLevel()][$this->getMethod()][$this->getCurrency()]['secret_key'];
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


    public function getTx()
    {
        return $this->getParameter('tx');

    }
    public function setTx()
    {
        return $this->getParameter('tx');

    }

    public function getRedirecturl()
    {
        return $this->getKeys()['redirect_url'];
    }

    public function getCallbackurl()
    {
        return $this->getParameter('callback_url');
    }
    public function setCallbackurl($value)
    {
        return $this->setParameter('callback_url', $value);
    }


    public function getMethod()
    {
        return $this->getParameter('method');
    }
    public function setMethod($value)
    {
        return $this->setParameter('method', $value);
    }

    public function getAdditionaldata()
    {
        return $this->getParameter('additional_data');
    }
    public function setAdditionaldata($value)
    {
        return $this->setParameter('additional_data', $value);
    }

    public function getLevel()
    {
        if ($this->getParameter('level'))
            return 'first_level';
        return 'second_level';
    }
    public function setLevel($value)
    {
        return $this->setParameter('level', $value);
    }


    public function getData()
    {
        $this->validate('amount', 'currency', 'level', 'method', 'additional_data', 'callback_url');

        $data = [
            'endpoint' => $this->getApikey(),
            'amount' => $this->getAmount(),
            'currency' => MapperCodeCurrency::convertCurrencyNameToCode($this->getCurrency()),
            'client_id' => $this->getTx(),
            'success_url' => $this->getRedirecturl(),
            'fail_url' => $this->getRedirecturl(),
            'notify_url' => $this->getCallbackurl(),
            'additional_data' => $this->getAdditionalData(),

        ];
        return array_filter($data, function ($value) {
            return $value !== null;
        });

    }

    public function sendData($data)
    {


        $jsonData = json_encode($data);
        $headers = [
            'Content-Type' => 'application/json',
            'API-Sign' => hash('sha256', $this->getSecretKey() . $jsonData)
        ];

        $httpResponse = $this->httpClient->request('POST', 'https://api.pay-planet.com/api/v1/paymentgate/payment/'. $this->getMethod() .'/', $headers, $jsonData);
        return $this->createResponse($httpResponse->getBody()->getContents());
    }


    protected function createResponse($data)
    {
        return $this->response = new PurchaseResponse($this, json_decode($data, true));
    }

}

