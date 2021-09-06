<?php

namespace Paytic\Omnipay\Librapay\Message;

use ByTIC\Omnipay\Common\Library\Signer;
use ByTIC\Omnipay\Common\Message\Traits\RequestDataGetWithValidationTrait;
use Paytic\Omnipay\Librapay\Helper;
use Paytic\Omnipay\Librapay\Models\Order\CustomData;
use Paytic\Omnipay\Librapay\Models\Transactions\Purchase;

/**
 * Class PurchaseRequest
 * @package Paytic\Omnipay\Librapay\Message
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
    protected function validateDataFields()
    {
        $params = [
            'amount',
            'orderId',
//            'orderId', 'orderName', 'orderDate',
//            'notifyUrl', 'returnUrl', 'signature', 'certificate',
//            'card'
        ];
        return array_merge($params, parent::validateDataFields());
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

        $data['data_custom'] = CustomData::fromRequest($this)->__toString();
        $data['string'] = $data['purchase']->__toString();
        $data['p_sign'] = Helper::generateSignHash($data['string'], $this->getKey());

        $data['redirectUrl'] = $this->getEndpointUrl();

        return $data;
    }
}
