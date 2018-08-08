<?php

namespace ByTIC\Omnipay\Librapay\Message\Traits;

use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationRequestTrait;
use ByTIC\Omnipay\Librapay\Helper;
use ByTIC\Omnipay\Librapay\Models\Transactions\PurchaseConfirmation;
use Exception;
use Symfony\Component\HttpFoundation\ParameterBag;

trait CompletePurchaseRequestTrait
{
    use GatewayNotificationRequestTrait;
    /**
     * @return bool|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     * @throws Exception
     */
    protected function parseNotification()
    {
        $httpParameters = $this->getHttpRequestBag();
        $this->populateFromHttpRequest($httpParameters);
        $this->validate(...$this->validateDataFields());

        $purchaseConfirmation = PurchaseConfirmation::fromRequest($this);
        $purchaseConfirmation->populateFromHttpRequest($httpParameters);

        $string = $purchaseConfirmation->__toString();
        $p_sign = Helper::generateSignHash($string, $this->getKey());

        $this->setDataItem('code', $purchaseConfirmation->getRc());
        $this->setDataItem('string', $string);
        $this->setDataItem('message', $purchaseConfirmation->getMessage());

        if ($httpParameters->get('P_SIGN') == $p_sign) {
            return $purchaseConfirmation->toArray();
        }

        return [];
    }

    protected function populateFromHttpRequest(ParameterBag $parameters)
    {
        $this->setAmount($parameters->get('AMOUNT'));
        $this->setCurrency($parameters->get('CURRENCY'));
        $this->setOrderId($parameters->get('ORDER'));
        $this->setDescription($parameters->get('DESC'));
    }

    abstract protected function getHttpRequestBag() : ParameterBag;

    /** @noinspection PhpMissingParentCallCommonInspection
     * @inheritdoc
     */
    protected function validateDataFields()
    {
        $params = [
            'amount',
            'orderId'
        ];
        return array_merge($params, parent::validateDataFields());
    }

    /**
     * @return mixed
     */
    protected function isValidNotification()
    {
        $parameters = $this->getHttpRequestBag();
        return $parameters->has('TERMINAL')
            && $parameters->has('INT_REF')
            && $parameters->has('P_SIGN');
    }
}