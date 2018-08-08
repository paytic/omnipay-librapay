<?php

namespace ByTIC\Omnipay\Librapay\Message;

use ByTIC\Omnipay\Common\Library\Signer;
use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationRequestTrait;
use ByTIC\Omnipay\Librapay\Message\Traits\CompletePurchaseRequestTrait;
use Exception;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class PurchaseResponse
 * @package ByTIC\Common\Payments\Gateways\Providers\AbstractGateway\Messages
 *
 * @method ServerCompletePurchaseResponse send()
 */
class ServerCompletePurchaseRequest extends AbstractRequest
{
    use CompletePurchaseRequestTrait;

    protected function getHttpRequestBag(): ParameterBag
    {
        return $this->httpRequest->request;
    }
}
