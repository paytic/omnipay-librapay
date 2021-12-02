<?php

namespace Paytic\Omnipay\Librapay\Tests\Models\Transactions;

use Paytic\Omnipay\Librapay\Models\Transactions\Purchase;
use Paytic\Omnipay\Librapay\Tests\AbstractTest;

/**
 * Class PurchaseTest
 * @package Paytic\Omnipay\Librapay\Tests\Models\Purchase
 */
class PurchaseTest extends AbstractTest
{
    public function testToString()
    {
        $purchase = Purchase::fromParams([
            'amount' => '3.49',
            'currency' => 'RON',
            'order' => '100005',
            'desc' => 'Comanda online #100005',
            'merch_name' => 'ASOCIATIA CLUB SPORTIV ELITE RUNNING',
            'merch_url' => 'register.42km.ro',
            'merchant' => '000000088002369',
            'terminal' => '88002369',
            'email' => 'vladv63@yahoo.com',
            'timestamp' => '20180806104111',
            'nonce' => '31c94694ed3ca86f107c05bf7209a18d',
            'backref' => 'register.42km.ro/testResponse.librapay.php',
        ]);

        self::assertSame(
            '43.493RON610000522Comanda online #10000536ASOCIATIA CLUB SPORTIV ELITE RUNNING16register.42km.ro1500000008800236988800236917vladv63@yahoo.com10--14201808061041113231c94694ed3ca86f107c05bf7209a18d42register.42km.ro/testResponse.librapay.php',
            $purchase->__toString()
        );
    }

    public function testLongDescription()
    {
        $purchase = Purchase::fromParams([
            'desc' => 'Plata Maratonul 1 Decembrie 2018 [#1533300867-187914]',
        ]);

        self::assertSame(50, strlen($purchase->getDesc()));
        self::assertSame(
            'Plata Maratonul 1 Decembrie 2018 [#1533300867-1879',
            $purchase->getDesc()
        );
    }
}
