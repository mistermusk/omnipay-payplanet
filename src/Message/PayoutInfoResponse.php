<?php

namespace Omnipay\PayPlanet\Message;

use Omnipay\Common\Message\AbstractResponse;

class PayoutInfoResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return isset($this->data['tx']);
    }

    public function getTransactionId()
    {
        return isset($this->data['tx']['tx']) ? $this->data['tx']['tx'] : null;
    }

}
