<?php

namespace Paytic\Omnipay\Librapay\Message\Traits;

use Paytic\Omnipay\Common\Message\Traits\GatewayNotificationResponseTrait;
use Paytic\Omnipay\Common\Message\Traits\HtmlResponses\ConfirmHtmlTrait;

trait CompletePurchaseResponseTrait
{
    use ConfirmHtmlTrait;
    use GatewayNotificationResponseTrait;

    /**
     * @inheritdoc
     */
    public function isSuccessful()
    {
        return $this->hasNotificationDataItem('rc')
            && $this->getNotificationDataItem('rc') == '00';
    }

    /**
     * @inheritdoc
     */
    public function isCancelled()
    {
        return $this->hasNotificationDataItem('rc')
            && $this->getNotificationDataItem('rc') != '00';
    }

    /**
     * @inheritdoc
     */
    public function getCode()
    {
        if ($this->hasDataProperty('code')) {
            return $this->getDataProperty('code');
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
        if ($this->hasDataProperty('message')) {
            return $this->getDataProperty('message');
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
