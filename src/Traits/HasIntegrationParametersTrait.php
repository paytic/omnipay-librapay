<?php

namespace Paytic\Omnipay\Librapay\Traits;

trait HasIntegrationParametersTrait
{

    /**
     * @return mixed
     */
    public function getMerchant()
    {
        return $this->getParameter('merchant');
    }

    /**
     * @param $value
     * @return static
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
     * @return static
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
     * @return static
     */
    public function setMerchantName($value)
    {
        return $this->setParameter('merchantName', $value);
    }

    /**
     * @return mixed
     */
    public function getMerchantEmail()
    {
        return $this->getParameter('merchantEmail');
    }

    /**
     * @param $value
     * @return static
     */
    public function setMerchantEmail($value)
    {
        return $this->setParameter('merchantEmail', $value);
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
     * @return static
     */
    public function setMerchantUrl($value)
    {
        return $this->setParameter('merchantUrl', $value);
    }
}
