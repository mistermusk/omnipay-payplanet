<?php

namespace Omnipay\PayPlanet\Message;

use Omnipay\Common\Message\AbstractResponse;

class PayoutResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return isset($this->data['info']['status']) && $this->data['info']['status'] === 'success';
    }

    public function getTransactionReference()
    {
        return isset($this->data['tx']['tx']) ? $this->data['tx']['tx'] : null;
    }

    public function getMessage()
    {
        return isset($this->data['errors']) ? json_encode($this->data['errors']) : null;
    }

}
