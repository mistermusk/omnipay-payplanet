<?php

namespace Omnipay\PayPlanet\Message;

use Omnipay\Common\Message\AbstractResponse;

class PayoutResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        $successfulStatuses = ['create', 'moderation', 'process', 'queue', 'waiting', 'preauth', 'success'];
        if (isset($this->data['tx']['status']) && in_array($this->data['tx']['status'], $successfulStatuses)) {
            return true;
        } else {
            return false;
        }
    }


    public function getMessage()
    {
        return isset($this->data) ? json_encode($this->data) : null;
    }
    public function getStatus()
    {
        return $this->data['tx']['status'];
    }

    public function getTx()
    {
        return isset($this->data['tx']['tx']) ? $this->data['tx']['tx'] : null;
    }

}
