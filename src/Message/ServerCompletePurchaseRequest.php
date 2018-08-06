<?php

namespace ByTIC\Omnipay\Librapay\Message;

use ByTIC\Omnipay\Common\Library\Signer;
use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationRequestTrait;
use Exception;

/**
 * Class PurchaseResponse
 * @package ByTIC\Common\Payments\Gateways\Providers\AbstractGateway\Messages
 *
 * @method ServerCompletePurchaseResponse send()
 */
class ServerCompletePurchaseRequest extends AbstractRequest
{
    use GatewayNotificationRequestTrait {
        getData as traitGetData;
    }

    /**
     * @inheritdoc
     */
    public function getData()
    {
        try {
            $this->traitGetData();
        } catch (Exception $exception) {
            $this->setDataItem('code', '');
            $this->setDataItem('codeType', $exception->getCode());
            $this->setDataItem('message', $exception->getMessage());
        }

        return $this->getDataArray();
    }

    /**
     * @return mixed
     */
    protected function isValidNotification()
    {
        return $this->hasPOST('env_key') || $this->hasPOST('data');
    }

    /**
     * @return bool|mixed
     * @throws Exception
     */
    protected function parseNotification()
    {
        $notification = [];

        return $notification;
    }
}
