<?php

namespace ByTIC\Omnipay\Librapay\Message;

use ByTIC\Omnipay\Common\Message\Traits\RedirectHtmlTrait;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * PayU Purchase Response
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    use RedirectHtmlTrait;

    /**
     * @return array
     */
    public function getRedirectData()
    {
        $data = [
            'AMOUNT' => $this->getDataProperty('amount'),
            'CURRENCY' => $this->getDataProperty('currency'),
            'ORDER' => $this->getDataProperty('order'),
            'DESC' => $this->getDataProperty('order'),
            'TERMINAL' => $this->getDataProperty('order'),
            'TIMESTAMP' => $this->getDataProperty('order'),
            'NONCE' => $this->getDataProperty('order'),
            'BACKREF' => $this->getDataProperty('order'),
            'DATA_CUSTOM' => $this->getDataProperty('order'),
            'STRING' => $this->getDataProperty('order'),
            'P_SIGN' => $this->getDataProperty('order')
        ];

        return $data;
    }
}
