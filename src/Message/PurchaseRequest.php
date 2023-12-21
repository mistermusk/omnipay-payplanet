<?php


namespace Omnipay\PayPlanet\Message;
use Omnipay\PayPlanet\Message\MapperCodeCurrency;
use Omnipay\Common\Message\AbstractRequest;

class PurchaseRequest extends AbstractRequest
{

    public function setFullKeys($fullKeys){
        return $this->setParameter('fullKeys', $fullKeys);
    }

    public function getFullKeys()
    {
        return $this->getParameter('fullKeys');
    }

    public function getApikey()
    {
        return $this->getFullKeys()[$this->getMethod()]['api_key'];
    }

    public function getSecretKey()
    {
        return $this->getFullKeys()[$this->getMethod()]['secret_key'];
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


    public function getClientId()
    {
        return $this->getParameter('client_id');

    }

    public function getSuccessUrl()
    {
        return $this->getParameter('success_url');
    }
    public function setSuccessUrl($value)
    {
        return $this->setParameter('success_url', $value);
    }

    public function getFailUrl()
    {
        return $this->getParameter('fail_url');
    }
    public function setFailUrl($value)
    {
        return $this->setParameter('fail_url', $value);
    }

    public function getNotifyUrl()
    {
        return $this->getParameter('notify_url');
    }
    public function setNotifyUrl($value)
    {
        return $this->setParameter('notify_url', $value);
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


    public function getData()
    {
        $this->validate('amount', 'currency');

        $data = [
            'endpoint' => $this->getApikey(),
            'amount' => $this->getAmount(),
            'currency' => MapperCodeCurrency::convertCurrencyNameToCode($this->getCurrency()),
            'client_id' => $this->getClientId(),
            'success_url' => $this->getSuccessUrl(),
            'fail_url' => $this->getFailUrl(),
            'notify_url' => $this->getNotifyUrl(),
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

