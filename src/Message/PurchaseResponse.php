<?php


namespace Omnipay\PayPlanet\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    public function isSuccessful()
    {
        return isset($this->data['payment']['status']) && $this->data['payment']['status'] === 'create';
    }

    public function isRedirect()
    {
        return isset($this->data['redirect_url']);
    }

    public function getRedirectUrl()
    {
        return $this->isRedirect() ? $this->data['redirect_url'] : null;
    }

    public function getTransactionReference()
    {
        return isset($this->data['tx']) ? $this->data['tx'] : null;
    }

    public function getMessage()
    {
        return isset($this->data['errors']) ? json_encode($this->data['errors']) : null;
    }

    public function getPaymentStatus()
    {
        return isset($this->data['payment']['status']) ? $this->data['payment']['status'] : null;
    }

    public function getQrCode()
    {
        return isset($this->data['qr_code']['qrcode']) ? $this->data['qr_code']['qrcode'] : null;
    }

}
