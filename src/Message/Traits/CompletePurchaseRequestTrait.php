<?php

namespace ByTIC\Omnipay\Librapay\Message\Traits;

use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationRequestTrait;
use ByTIC\Omnipay\Librapay\Helper;
use ByTIC\Omnipay\Librapay\Models\Transactions\PurchaseConfirmation;
use Exception;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Trait CompletePurchaseRequestTrait
 * @package ByTIC\Omnipay\Librapay\Message\Traits
 */
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
        $this->setDataItem('p_string', $httpParameters->get('P_SIGN'));
        $this->setDataItem('string', $string);
        $this->setDataItem('message', $purchaseConfirmation->getMessage());

        if ($httpParameters->get('P_SIGN') == $p_sign) {
            return $purchaseConfirmation->toArray();
        }

        return [];
    }

    /**
     * @param ParameterBag $parameters
     */
    protected function populateFromHttpRequest(ParameterBag $parameters)
    {
        $fields = [
            'setMerchant' => 'MERCHANT',
            'setTerminal' => 'TERMINAL',
            'setAmount' => 'AMOUNT',
            'setCurrency' => 'CURRENCY',
            'setOrderId' => 'ORDER',
            'setDescription' => 'DESC',
        ];

        foreach ($fields as $method=>$field) {
            if ($parameters->has($field)) {
                $this->$method($parameters->get($field));
            }
        }
    }

    /**
     * @return ParameterBag
     */
    protected function getHttpRequestBag(): ParameterBag
    {
        if ($this->httpRequest->request->count() > 0 && $this->httpRequest->request->has('TERMINAL')) {
            return $this->httpRequest->request;
        }

        return $this->httpRequest->query;
    }

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
    public function isValidNotification()
    {
        $parameters = $this->getHttpRequestBag();
        return $parameters->has('TERMINAL')
            && $parameters->has('INT_REF')
            && $parameters->has('P_SIGN')
            && $parameters->has('NONCE')
            && $parameters->has('RRN') // This is different from Romcard notification
            && $parameters->has('RC');
    }
}
