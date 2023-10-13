<?php


namespace Omnipay\PayPlanet\Message;

use Omnipay\Common\Message\AbstractRequest;

class WebhookRequest extends AbstractRequest
{
    public function getEndpoint()
    {
        return 'https://api.pay-planet.com/api/v1/paymentgate/callback/info/payment/';
    }

    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
    }

    public function getData()
    {
        // Получить JSON данные из тела запроса
        $data = json_decode($this->httpRequest->getContent(), true);

        // Дополнительные проверки данных (например, наличие всех необходимых полей) могут быть добавлены здесь

        return $data;
    }

    public function isValid()
    {
        // Получаем подпись из заголовка
        $headerSignature = $this->httpRequest->headers->get('API-Sign');

        // Вычисляем ожидаемую подпись
        $expectedSignature = hash_hmac('sha256', $this->httpRequest->getContent(), $this->getSecretKey());

        // Сравниваем полученную подпись с вычисленной
        return hash_equals($expectedSignature, $headerSignature);
    }
}
