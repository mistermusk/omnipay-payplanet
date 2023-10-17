<?php

namespace Omnipay\PayPlanet\Message;

use Omnipay\Common\Message\AbstractResponse;

class PayoutResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        if (isset($this->data['redirect_url'])) {
            return true;
        }
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
