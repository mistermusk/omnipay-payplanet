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

    public function getMessage()
    {
        return isset($this->data) ? json_encode($this->data) : null;
    }

}
