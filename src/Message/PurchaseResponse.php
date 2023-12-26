<?php


namespace Omnipay\PayPlanet\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    public function isSuccessful()
    {
        $successfulStatuses = ['create', 'moderation', 'process', 'queue', 'waiting', 'preauth', 'success'];
        if (isset($this->data['info']['status']) && in_array($this->data['info']['status'], $successfulStatuses)) {
            return true;
        } else {
            return false;
        }
    }

    public function getTx()
    {
        return isset($this->data['info']['tx']) ? json_encode($this->data['info']['tx']) : null;
    }

    public function getStatus()
    {
        return isset($this->data['info']['status']) ? json_encode($this->data['info']['status']) : null;
    }

    public function getMessage()
    {
        return isset($this->data) ? json_encode($this->data) : null;
    }

    public function getRedirectUrl()
    {
        return $this->data['redirect_url'];
    }

}
