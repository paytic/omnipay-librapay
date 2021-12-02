<?php

namespace Paytic\Omnipay\Librapay\Message;

use Paytic\Omnipay\Common\Library\Signer;
use Paytic\Omnipay\Common\Message\Traits\GatewayNotificationRequestTrait;
use Paytic\Omnipay\Librapay\Message\Traits\CompletePurchaseRequestTrait;
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
}
