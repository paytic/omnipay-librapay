<?php

namespace Paytic\Omnipay\Librapay\Message;


use Paytic\Omnipay\Librapay\Message\Traits\CompletePurchaseResponseTrait;

/**
 * Class PurchaseResponse
 * @package Paytic\Omnipay\Librapay\Message
 */
class CompletePurchaseResponse extends AbstractResponse
{
    use CompletePurchaseResponseTrait;
}
