<?php

namespace ByTIC\Omnipay\Librapay\Message;

use ByTIC\Omnipay\Common\Library\Signer;
use ByTIC\Omnipay\Common\Message\Traits\RequestDataGetWithValidationTrait;

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
     */
    protected function populateData()
    {
        $data = [];

        $data['AMOUNT'] = $this->getAmount();
        $data['CURRENCY'] = $this->getCurrency();
        $data['ORDER'] = $this->getCurrency();
        $data['DESC'] = $this->getCurrency();
        $data['TERMINAL'] = $this->getTerminal();
        $data['TIMESTAMP'] = gmdate( "YmdHis");
        $data['NONCE'] = md5("shopperkey_".rand(99999,9999999));

        $data['BACKREF'] = $this->getEndpointUrl();

        $signer = new Signer();
        $signer->setCertificate($this->getCertificate());


        return $data;
    }
}
