<?php

namespace Paytic\Omnipay\Librapay;

/**
 * Class Helper
 * @package Paytic\Omnipay\Librapay
 */
class Helper extends \Paytic\Omnipay\Common\Helper
{
    /**
     * @param string $string
     * @param string $key
     * @return string
     */
    public static function generateSignHash(string $string, string $key)
    {
        $hexKey = pack('H*', $key);

        return strtoupper(hash_hmac('sha1', $string, $hexKey));;
    }

}
