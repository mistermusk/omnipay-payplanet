<?php


namespace Omnipay\PayPlanet\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
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

    public function getRedirectUrl()
    {
        return $this->isSuccessful() ? $this->data['redirect_url'] : null;
    }

}
