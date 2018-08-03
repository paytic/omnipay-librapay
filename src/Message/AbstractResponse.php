<?php

namespace ByTIC\Omnipay\Librapay\Message;

use ByTIC\Omnipay\Common\Message\Traits\DataAccessorsTrait;
use Omnipay\Common\Message\AbstractResponse as CommonAbstractResponse;

/**
 * Class Response
 * @package ByTIC\Omnipay\Librapay\Message
 */
abstract class AbstractResponse extends CommonAbstractResponse
{
    use DataAccessorsTrait;

    /**
     * @inheritdoc
     */
    public function isSuccessful()
    {
        return
            isset($this->data['success'])
            && $this->data['success'];
    }
}
