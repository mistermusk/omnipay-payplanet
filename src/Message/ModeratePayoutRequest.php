<?php


namespace Omnipay\PayPlanet\Message;
use Omnipay\PayPlanet\Message\MapperCodeCurrency;
use Omnipay\Common\Message\AbstractRequest;

class ModeratePayoutRequest extends AbstractRequest
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
        return $this->getKeys()['api_withdrawal'][$this->getMethod()][$this->getCurrency()]['api_key'];
    }

    public function getSecretKey()
    {
        return $this->getKeys()['api_withdrawal'][$this->getMethod()][$this->getCurrency()]['secret_key'];
    }

    public function getCurrency()
    {
        return $this->getParameter('currency');
    }

    public function setCurrency($value)
    {
        return $this->setParameter('currency', $value);
    }



    public function getMethod()
    {
        return $this->getParameter('method');
    }
    public function setMethod($value)
    {
        return $this->setParameter('method', $value);
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
        $data = [
            'endpoint' => $this->getApikey(),
            'tx' => $this->getTx(),
            'moderated' => true,

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

        $httpResponse = $this->httpClient->request('POST', 'https://api.pay-planet.com/api/v1/paymentgate/payout/moderate/', $headers, $jsonData);
        return $this->createResponse($httpResponse->getBody()->getContents());
    }


    protected function createResponse($data)
    {
        return $this->response = new ModeratePayoutResponse($this, json_decode($data, true));
    }

}

