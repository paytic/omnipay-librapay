<?php

namespace ByTIC\Omnipay\Librapay\Message;

use ByTIC\Omnipay\Common\Library\Signer;
use ByTIC\Omnipay\Common\Message\Traits\RequestDataGetWithValidationTrait;
use ByTIC\Omnipay\Librapay\Helper;
use ByTIC\Omnipay\Librapay\Models\Order\CustomData;
use ByTIC\Omnipay\Librapay\Models\Transactions\Purchase;

/**
 * Class PurchaseRequest
 * @package ByTIC\Omnipay\Librapay\Message
 *
 * @method PurchaseResponse send()
 */
class PurchaseRequest extends AbstractRequest
{
    use RequestDataGetWithValidationTrait;

    /**
     * @inheritdoc
     */
    public function initialize(array $parameters = [])
    {
        $parameters['currency'] = isset($parameters['currency']) ? $parameters['currency'] : 'ron';

        return parent::initialize($parameters);
    }


    /** @noinspection PhpMissingParentCallCommonInspection
     * @inheritdoc
     */
    public function validateDataFields()
    {
        return [
            'merchant',
            'terminal',
            'key',
            'amount',
            'orderId',
//            'orderId', 'orderName', 'orderDate',
//            'notifyUrl', 'returnUrl', 'signature', 'certificate',
//            'card'
        ];
    }

    /**
     * @inheritdoc
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    protected function populateData()
    {
        $data = [];

        $data['purchase'] = Purchase::fromRequest($this);

        $data['backref'] = $this->getReturnUrl();
        $data['postAction'] = $this->getNotifyUrl();

        $data['data_custom'] = CustomData::fromRequest($this)->__toString();
        $data['string'] = $data['purchase']->__toString();
        $data['p_sign'] = Helper::generateSignHash($data['purchase']->__toString(), $this->getKey());

        $data['redirectUrl'] = $this->getEndpointUrl();

        return $data;
    }
}
