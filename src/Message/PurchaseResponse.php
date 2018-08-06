<?php

namespace ByTIC\Omnipay\Librapay\Message;

use ByTIC\Omnipay\Common\Message\Traits\RedirectHtmlTrait;
use ByTIC\Omnipay\Librapay\Models\Transactions\Purchase;
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
        /** @var Purchase $purchase */
        $purchase = $this->getDataProperty('purchase');

        $data = [
            'AMOUNT' => $purchase->getAmount(),
            'CURRENCY' => $purchase->getCurrency(),
            'ORDER' => $purchase->getOrder(),
            'DESC' => $purchase->getDesc(),
            'TERMINAL' => $purchase->getTerminal(),
            'TIMESTAMP' => $purchase->getTimestamp(),
            'NONCE' => $purchase->nonce(),

            'BACKREF' => $this->getDataProperty('backref'),

            'DATA_CUSTOM' => $this->getDataProperty('data_custom'),
            'STRING' => $this->getDataProperty('string'),
            'P_SIGN' => $this->getDataProperty('p_sign')
        ];

        return $data;
    }
}
