<?php

namespace Paytic\Omnipay\Librapay\Message;

use Paytic\Omnipay\Librapay\Message\Traits\CompletePurchaseResponseTrait;

/**
 * Class PurchaseResponse
 * @package Paytic\Omnipay\Librapay\Message
 */
class ServerCompletePurchaseResponse extends AbstractResponse
{
    use CompletePurchaseResponseTrait;

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
        if (count($this->getDataProperty('notification')) > 0) {
            return '1';
        }

        return "<br />1:" . $this->getDataProperty('p_string')
            . '<br />2:' . $this->getDataProperty('string')
            . '0';
    }
}
