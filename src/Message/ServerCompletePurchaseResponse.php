<?php

namespace ByTIC\Omnipay\Librapay\Message;

use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationResponseTrait;

/**
 * Class PurchaseResponse
 * @package ByTIC\Omnipay\Librapay\Message
 */
class ServerCompletePurchaseResponse extends AbstractResponse
{
    use GatewayNotificationResponseTrait;

    /** @noinspection PhpMissingParentCallCommonInspection
     * @inheritdoc
     */
    public function isSuccessful()
    {
        return $this->getCode() == 0;
    }


    /**
     * @inheritdoc
     */
    public function isPending()
    {
        if ($this->getCode() == 0) {
            return false;
        }

        return parent::isPending();
    }

    /**
     * @inheritdoc
     */
    public function isCancelled()
    {
        if ($this->getCode() == 0) {
            return false;
        }

        return parent::isCancelled();
    }

    public function send()
    {
        header('Content-type: application/xml');
        echo $this->getContent();
    }

    /**
     * @return string
     */
    public function getContent()
    {
        $content = "";

        return $content;
    }
}
