<?php

namespace Omnipay\PayPlanet\Message;

use Omnipay\Common\Message\AbstractResponse;

class FetchTransactionResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        // Implement logic based on API response
        return isset($this->data['redirect_url']);
    }

    public function getRedirectUrl()
    {
        return $this->data['redirect_url'] ?? null;
    }

    public function getInfo()
    {
        return $this->data['info'] ?? null;
    }

    public function getQrCode()
    {
        return $this->data['qr_code'] ?? null;
    }

}
