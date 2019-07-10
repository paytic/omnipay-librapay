<?php

namespace ByTIC\Omnipay\Librapay\Tests;

use ByTIC\Omnipay\Librapay\Helper;

/**
 * Class HelperTest
 * @package ByTIC\Omnipay\Librapay\Tests
 */
class HelperTest extends AbstractTest
{
    public function testGenerateSignHash()
    {
        $string = '43.493RON610000522Comanda online #10000536ASOCIATIA CLUB SPORTIV ELITE RUNNING16register.42km.ro1500000008800236988800236917vladv63@yahoo.com10--14201808061041113231c94694ed3ca86f107c05bf7209a18d42register.42km.ro/testResponse.librapay.php';
        $hash = Helper::generateSignHash($string, getenv('LIBRAPAY_KEY'));
        self::assertSame('314B1B74801928950C76A21093F360F08680700B', $hash);
    }
}