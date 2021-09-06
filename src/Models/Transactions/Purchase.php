<?php

namespace Paytic\Omnipay\Librapay\Models\Transactions;

use Paytic\Omnipay\Librapay\Message\AbstractRequest;
use Paytic\Omnipay\Librapay\Message\Traits\CompletePurchaseRequestTrait;
use Paytic\Omnipay\Librapay\Models\AbstractModel;

/**
 * Class Transaction
 * @package Paytic\Omnipay\Librapay\Models
 */
class Purchase extends AbstractModel
{
    /**
     * @var float
     */
    protected $amount;

    /**
     * 3 letter string
     * @var
     */
    protected $currency;

    /**
     * Order ID. It must have at least 6 and maximum 19 numeric chars, must be unique for every order and
     * it must not contain leading zero (valid example: 100001)
     * @var int
     */
    protected $order;

    /**
     * Order description displayed in the LibraPay. Limit 50 characters
     * @var string
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
     * @param array $params
     * @return static
     */
    public static function fromParams($params = [])
    {
        $transaction = new static();
        $fields = static::getFieldsForString();
        foreach ($fields as $field) {
            if (isset($params[$field])) {
                $transaction->initParam($field, $params[$field]);
            }
        }

        return $transaction;
    }

    /**
     * @param AbstractRequest|CompletePurchaseRequestTrait $request
     * @return static
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public static function fromRequest(AbstractRequest $request)
    {
        $transaction = new static();
        $transaction->initParam('amount', $request->getAmount());
        $transaction->initParam('currency', $request->getCurrency());
        $transaction->initParam('order', $request->getOrderId());
        $transaction->initParam('desc', $request->getDescription());
        $transaction->initParam('merch_name', $request->getMerchantName());
        $transaction->initParam('merch_url', $request->getMerchantUrl());
        $transaction->initParam('merchant', $request->getMerchant());
        $transaction->initParam('terminal', $request->getTerminal());
        $transaction->initParam('email', $request->getMerchantEmail());
//            $transaction->country= $request->getCard()->getCountry();
        $transaction->initParam('timestamp', gmdate("YmdHis"));
        $transaction->initParam('nonce', md5("bytic".rand(99999, 9999999)));
        $transaction->initParam('backref', $request->getReturnUrl());

        $transaction->validateData();

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
     * @param string $desc
     */
    public function setDesc(string $desc)
    {
        $desc = substr($desc, 0, 50);
        $this->desc = $desc;
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
     * @return string
     */
    public function __toString()
    {
        $fields = static::getFieldsForString();
        $return = '';
        foreach ($fields as $field) {
            $return .= in_array($field, ['country', 'merch_gmt'])
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
     * @inheritdoc
     */
    protected function validateDataFields()
    {
        return ['amount', 'order'];
    }

    /**
     * @return array
     */
    protected static function getFieldsForString()
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
