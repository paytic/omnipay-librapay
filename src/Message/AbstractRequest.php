<?php

namespace ByTIC\Omnipay\Librapay\Message;

use ByTIC\Omnipay\Common\Message\Traits\SendDataRequestTrait;
use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;

/**
 * Class AbstractRequest
 * @package ByTIC\Omnipay\Librapay\Message
 */
abstract class AbstractRequest extends CommonAbstractRequest
{
    use SendDataRequestTrait;

    /**
     * @return mixed
     */
    public function getMerchant()
    {
        return $this->getParameter('merchant');
    }

    /**
     * @param $value
     * @return CommonAbstractRequest
     */
    public function setMerchant($value)
    {
        return $this->setParameter('merchant', $value);
    }

    /**
     * @return mixed
     */
    public function getTerminal()
    {
        return $this->getParameter('terminal');
    }

    /**
     * @param $value
     * @return CommonAbstractRequest
     */
    public function setTerminal($value)
    {
        return $this->setParameter('terminal', $value);
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->getParameter('key');
    }

    /**
     * @param $value
     * @return CommonAbstractRequest
     */
    public function setKey($value)
    {
        return $this->setParameter('key', $value);
    }

    /**
     * @return mixed
     */
    public function getMerchantName()
    {
        return $this->getParameter('merchantName');
    }

    /**
     * @param $value
     * @return CommonAbstractRequest
     */
    public function setMerchantName($value)
    {
        return $this->setParameter('merchantName', $value);
    }

    /**
     * @return mixed
     */
    public function getMerchantUrl()
    {
        return $this->getParameter('merchantUrl');
    }

    /**
     * @param $value
     * @return CommonAbstractRequest
     */
    public function setMerchantUrl($value)
    {
        return $this->setParameter('merchantUrl', $value);
    }

    /**
     * @return mixed
     */
    public function getEndpointUrl()
    {
        return $this->getParameter('endpointUrl');
    }

    /**
     * @param $value
     * @return CommonAbstractRequest
     */
    public function setEndpointUrl($value)
    {
        return $this->setParameter('endpointUrl', $value);
    }
    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }

    /**
     * @param  string $value
     * @return mixed
     */
    public function setOrderId($value)
    {
        return $this->setParameter('orderId', $value);
    }
}
