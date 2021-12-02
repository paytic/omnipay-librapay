<?php

namespace Paytic\Omnipay\Librapay\Message;

use Paytic\Omnipay\Common\Message\Traits\DataAccessorsTrait;
use Omnipay\Common\Message\AbstractResponse as CommonAbstractResponse;

/**
 * Class Response
 * @package Paytic\Omnipay\Librapay\Message
 */
abstract class AbstractResponse extends CommonAbstractResponse
{
    use DataAccessorsTrait;
}
