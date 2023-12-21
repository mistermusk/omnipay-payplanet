<?php

namespace Omnipay\PayPlanet;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'PayPlanet';
    }

    private $keys = [];
    public function setKeys($method, $shop_id, $secret_key)
    {
        $this->keys[$method] = [
            'api_key' => $shop_id,
            'secret_key' => $secret_key,
        ];
    }

    public function getKeys($method)
    {
        return isset($this->keys[$method]) ? $this->keys[$method] : null;
    }

    public function getFullKeys()
    {
        return $this->keys;
    }

    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\PayPlanet\Message\PurchaseRequest', $parameters)
            ->setFullKeys($this->getFullKeys());
    }

    public function payout(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\PayPlanet\Message\PayoutRequest', $parameters)
            ->setFullKeys($this->getFullKeys());
    }

    public function moderated(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\PayPlanet\Message\ModeratePayoutRequest', $parameters)
            ->setFullKeys($this->getFullKeys());
    }


}
