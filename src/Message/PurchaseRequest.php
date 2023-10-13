<?php


namespace Omnipay\PayPlanet\Message;

use Omnipay\Common\Message\AbstractRequest;

class PurchaseRequest extends AbstractRequest
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

    public function getDescription()
    {
        return $this->getParameter('description');
    }

    public function setDescription($value)
    {
        return $this->setParameter('description', $value);
    }

    public function getClientId()
    {
        return $this->getParameter('client_id');

    }

    public function getData()
    {
        $this->validate('amount', 'currency');

        $data = [
            'endpoint' => $this->getEndpoint(),
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency(),
            'description' => $this->getDescription(),
            'client_id' => $this->getClientId(),

//            'success_url' => $this->getPan(),
//            'fail_url' => $this->getPan(),
//            'notify_url' => $this->getPan(),
//            'router_data' => $this->getPan(),
//            'custom_data' => $this->getPan(),
//            'payment_method' => $this->getPan(),
//            'additional_data' => $this->getPan(),
//            'auto_redirect' => $this->getPan(),
//            'buyer_id' => $this->getPan(),
//            'buyer' => $this->getPan(),

        ];
        return array_filter($data, function ($value) {
            return $value !== null;
        });

    }

    public function sendData($data)
    {
        $secretKey = $this->getParameter('secretKey');
        $jsonData = json_encode($data);
        print_r($data);
        $headers = [
            'Content-Type' => 'application/json',
            'API-Sign' => hash('sha256', $secretKey . $jsonData)
        ];

        $httpResponse = $this->httpClient->request('POST', $this->getApiEndpoint(), $headers, $jsonData);

        return $this->createResponse($httpResponse->getBody()->getContents());
    }


    protected function createResponse($data)
    {
        return $this->response = new PurchaseResponse($this, json_decode($data, true));
    }

    protected function getApiEndpoint()
    {
        return 'https://api.pay-planet.com/api/v1/paymentgate/payment/simple/';
    }
}

