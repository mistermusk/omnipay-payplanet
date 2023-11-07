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


    public function getRouterData()
    {
        return $this->getParameter('router_data');
    }
    public function setRouterData($value)
    {
        return $this->setParameter('router_data', $value);
    }


    public function getCustomData()
    {
        return $this->getParameter('custom_data');
    }
    public function setCustomData($value)
    {
        return $this->setParameter('custom_data', $value);
    }

    public function getAdditionalData()
    {
        return $this->getParameter('additional_data');
    }
    public function setAdditionalData($value)
    {
        return $this->setParameter('additional_data', $value);
    }

    public function getAutoRedirect()
    {
        return $this->getParameter('auto_redirect');
    }
    public function setAutoRedirect($value)
    {
        return $this->setParameter('auto_redirect', $value);
    }

    public function getBuyerId()
    {
        return $this->getParameter('buyer_id');
    }
    public function setBuyerId($value)
    {
        return $this->setParameter('buyer_id', $value);
    }

    public function getBuyer()
    {
        return $this->getParameter('buyer');
    }
    public function setBuyer($value)
    {
        return $this->setParameter('buyer', $value);
    }

    public function getMethod()
    {
        return $this->getParameter('method');
    }
    public function setMethod($value)
    {
        return $this->setParameter('method', $value);
    }


    public function getData()
    {
        $this->validate('amount', 'currency');

        $data = [
            'endpoint' => $this->getEndpoint(),
            'amount' => $this->getAmount(),
            'currency' => MapperCodeCurrency::convertCurrencyNameToCode($this->getCurrency()),
            'description' => $this->getDescription(),
            'client_id' => $this->getClientId(),
            'success_url' => $this->getSuccessUrl(),
            'fail_url' => $this->getFailUrl(),
            'notify_url' => $this->getNotifyUrl(),
            'router_data' => $this->getRouterData(),
            'custom_data' => $this->getCustomData(),
            'payment_method' => $this->getPaymentMethod(),
            'additional_data' => $this->getAdditionalData(),
            'auto_redirect' => $this->getAutoRedirect(),
            'buyer_id' => $this->getBuyerId(),
            'buyer' => $this->getBuyer(),

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

        $httpResponse = $this->httpClient->request('POST', $this->getApiEndpoint(), $headers, $jsonData);

        return $this->createResponse($httpResponse->getBody()->getContents());
    }


    protected function createResponse($data)
    {
        return $this->response = new PurchaseResponse($this, json_decode($data, true));
    }

    protected function getApiEndpoint()
    {
        $mth = $this->getMethod();
        return Methods::getLink(settype($mth, "integer"));
    }
}

