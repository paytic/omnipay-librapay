<?php

namespace ByTIC\Omnipay\Librapay\Message;

use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationResponseTrait;
use ByTIC\Omnipay\Common\Message\Traits\HtmlResponses\ConfirmHtmlTrait;

/**
 * Class PurchaseResponse
 * @package ByTIC\Omnipay\Librapay\Message
 */
class CompletePurchaseResponse extends AbstractResponse
{
    use ConfirmHtmlTrait;
    use GatewayNotificationResponseTrait;

    /**
     * @inheritdoc
     */
    public function isSuccessful()
    {
        return $this->getNotificationDataItem('action') == '0';
    }

    /**
     * @inheritdoc
     */
    public function isCancelled()
    {
        return in_array($this->getNotificationDataItem('action'), [2, 3]);
    }

    /**
     * @inheritdoc
     */
    public function getCode()
    {
        if ($this->hasNotificationDataItem('rc')) {
            return $this->getNotificationDataItem('rc');
        }

        return parent::getCode();
    }

    /**
     * @inheritdoc
     */
    public function getMessage()
    {
        if ($this->hasNotificationDataItem('message')) {
            return $this->getNotificationDataItem('message');
        }

        return parent::getMessage();
    }

    /**
     * @inheritdoc
     */
    public function getTransactionReference()
    {
        if ($this->hasNotificationDataItem('rrn')) {
            return $this->getNotificationDataItem('rrn');
        }

        return parent::getTransactionReference();
    }

    /**
     * @inheritdoc
     */
    public function getTransactionId()
    {
        if ($this->hasNotificationDataItem('order')) {
            return $this->getNotificationDataItem('order');
        }

        return parent::getTransactionId();
    }
}
