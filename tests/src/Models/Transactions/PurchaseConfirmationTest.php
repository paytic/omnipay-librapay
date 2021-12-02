<?php

namespace Paytic\Omnipay\Librapay\Tests\Models\Transactions;

use Paytic\Omnipay\Librapay\Models\Transactions\Purchase;
use Paytic\Omnipay\Librapay\Models\Transactions\PurchaseConfirmation;
use Paytic\Omnipay\Librapay\Tests\AbstractTest;

/**
 * Class PurchaseConfirmationTest
 * @package Paytic\Omnipay\Librapay\Tests\Models\Purchase
 */
class PurchaseConfirmationTest extends AbstractTest
{
    public function testToString()
    {
        $purchase = PurchaseConfirmation::fromParams([
            'terminal' => '88002369',
            'trtype' => '0',
            'order' => '100005',
            'amount' => '3.49',
            'currency' => 'RON',
            'desc' => 'Comanda online #100005',
            'action' => '0',
            'rc' => '00',
            'message' => 'Approved',
            'rrn' => '494108027545',
            'int_ref' => '9121996457I63PCK',
            'approval' => 'Z73S',
            'timestamp' => '20180807190200',
            'nonce' => '5a4cacbc879f7d85f3992aeb928a89f0',
        ]);

        self::assertSame(
            '88800236910610000543.493RON22Comanda online #100005102008Approved12494108027545169121996457I63PCK4Z73S1420180807190200325a4cacbc879f7d85f3992aeb928a89f0',
            $purchase->__toString()
        );
    }
}
