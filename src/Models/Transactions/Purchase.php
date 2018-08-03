<?php

namespace ByTIC\Omnipay\Librapay\Models\Transactions;

use ByTIC\Omnipay\Librapay\Message\AbstractRequest;
use ByTIC\Omnipay\Librapay\Models\AbstractModel;

/**
 * Class Transaction
 * @package ByTIC\Omnipay\Librapay\Models
 */
class Purchase extends AbstractModel
{
    /**
     * @var
     */
    protected $amount;

    /**
     * @var
     */
    protected $currency;

    /**
     * @var
     */
    protected $order;

    /**
     * @var
     */
    protected $desc;

    /**
     * @var
     */
    protected $merch_name;

    /**
     * @var
     */
    protected $merch_url;

    /**
     * @var
     */
    protected $merchant;

    /**
     * @var
     */
    protected $terminal;

    /**
     * @var
     */
    protected $email;

    /**
     * @var
     */
    protected $trtype = 0;

    /**
     * @var
     */
    protected $country = "-";

    /**
     * @var
     */
    protected $merch_gmt = "-";

    /**
     * @var
     */
    protected $timestamp;

    /**
     * @var
     */
    protected $nonce;

    /**
     * @var
     */
    protected $backref;

    /**
     * @param AbstractRequest $request
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public static function fromRequest(AbstractRequest $request)
    {
        $transaction = new self();
        $transaction->amount = $request->getAmount();
        $transaction->currency = $request->getCurrency();
        $transaction->order = $request->getOrderId();
        $transaction->desc = $request->getDescription();
        $transaction->merch_name = $request->getMerchantName();
        $transaction->merch_url = $request->getMerchantUrl();
        $transaction->merchant = $request->getMerchant();
        $transaction->terminal = $request->getTerminal();
        $transaction->email = $request->getCard()->getEmail();
//            $transaction->country= $request->getCard()->getCountry();
        $transaction->timestamp = gmdate("YmdHis");
        $transaction->nonce = md5("bytic".rand(99999, 9999999));
        $transaction->backref = $request->getReturnUrl();

        return $transaction;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return mixed
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @return mixed
     */
    public function getTerminal()
    {
        return $this->terminal;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @return mixed
     */
    public function nonce()
    {
        return $this->nonce;
    }

    /**
     *
     */
    public function __toString()
    {
        $fields = $this->getFieldsForString();
        $return = '';
        foreach ($fields as $field) {
            $return .= in_array($field, ['trtype', 'country'])
                ? $this->{$field}
                : $this->generatePropertyString($field);
        }

        return $return;
    }

    /**
     * @param $property
     * @return string
     */
    protected function generatePropertyString($property)
    {
        $value = $this->{$property};

        return strlen($value).$value;
    }

    /**
     * @return array
     */
    protected function getFieldsForString()
    {
        return [
            'amount',
            'currency',
            'order',
            'desc',
            'merch_name',
            'merch_url',
            'merchant',
            'terminal',
            'email',
            'trtype',
            'country',
            'merch_gmt',
            'timestamp',
            'nonce',
            'backref',
        ];
    }
}