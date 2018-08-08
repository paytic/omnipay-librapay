<?php

namespace ByTIC\Omnipay\Librapay\Message;

use ByTIC\Omnipay\Librapay\Message\Traits\CompletePurchaseRequestTrait;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class PurchaseResponse
 * @package ByTIC\Omnipay\Librapay\Message
 *
 * @method CompletePurchaseResponse send()
 */
class CompletePurchaseRequest extends AbstractRequest
{
    use CompletePurchaseRequestTrait;

    protected function getHttpRequestBag(): ParameterBag
    {
        return $this->httpRequest->query;
    }
}
