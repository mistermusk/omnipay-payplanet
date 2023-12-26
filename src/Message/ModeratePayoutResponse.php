<?php

namespace Omnipay\PayPlanet\Message;

use Omnipay\Common\Message\AbstractResponse;

class ModeratePayoutResponse extends AbstractResponse
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

    public function getStatus()
    {
        return isset($this->data['tx']['status']) ? $this->data['tx']['status'] : null;
    }

    public function getMessage()
    {
        return isset($this->data) ? json_encode($this->data) : null;
    }

}
