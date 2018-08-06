<?php

namespace ByTIC\Omnipay\Librapay\Message;

/**
 * Class PurchaseResponse
 * @package ByTIC\Omnipay\Librapay\Message
 */
class CompletePurchaseRequest extends AbstractRequest
{

    /**
     * @inheritdoc
     */
    public function getData()
    {
        $data = [];
        $data['orderId'] = $this->httpRequest->query->get('orderId');

        return $data;
    }
}
