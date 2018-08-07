<?php

namespace ByTIC\Omnipay\Librapay\Message;

use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationRequestTrait;
use ByTIC\Omnipay\Librapay\Helper;
use ByTIC\Omnipay\Librapay\Models\Transactions\PurchaseConfirmation;
use Exception;

/**
 * Class PurchaseResponse
 * @package ByTIC\Omnipay\Librapay\Message
 *
 * @method CompletePurchaseResponse send()
 */
class CompletePurchaseRequest extends AbstractRequest
{
    use GatewayNotificationRequestTrait;

    /**
     * @return bool|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     * @throws Exception
     */
    protected function parseNotification()
    {
        $this->populateFromHttpRequest();
        $this->validate(...$this->validateDataFields());

        $purchaseConfirmation = PurchaseConfirmation::fromRequest($this);
        $purchaseConfirmation->populateFromHttpRequest($this->httpRequest->query);

        $string = $purchaseConfirmation->__toString();
        $p_sign = Helper::generateSignHash($string, $this->getKey());

        if ($this->httpRequest->query->get('P_SIGN') != $p_sign) {
            throw new Exception(
                'Invalid P_SIGN'
            );
        }

        return $purchaseConfirmation->toArray();
    }

    protected function populateFromHttpRequest()
    {
        $this->setAmount($this->httpRequest->query->get('AMOUNT'));
        $this->setCurrency($this->httpRequest->query->get('CURRENCY'));
        $this->setOrderId($this->httpRequest->query->get('ORDER'));
        $this->setDescription($this->httpRequest->query->get('DESC'));
    }

    /** @noinspection PhpMissingParentCallCommonInspection
     * @inheritdoc
     */
    protected function validateDataFields()
    {
        $params = [
            'amount',
            'orderId'
        ];
        return array_merge($params, parent::validateDataFields());
    }

    /**
     * @return mixed
     */
    protected function isValidNotification()
    {
        return $this->hasGet('TERMINAL') && $this->hasGet('INT_REF') && $this->hasGet('P_SIGN');
    }
}
