<?php

namespace Paytic\Omnipay\Librapay\Message;

use Paytic\Omnipay\Librapay\Message\Traits\CompletePurchaseRequestTrait;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class PurchaseResponse
 * @package Paytic\Omnipay\Librapay\Message
 *
 * @method CompletePurchaseResponse send()
 */
class CompletePurchaseRequest extends AbstractRequest
{
    use CompletePurchaseRequestTrait;
}
