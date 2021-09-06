<?php

namespace Paytic\Omnipay\Librapay\Tests\Models\Order;

use Paytic\Omnipay\Librapay\Models\Order\BillingInfo;
use Paytic\Omnipay\Librapay\Tests\AbstractTest;
use Omnipay\Common\CreditCard;

/**
 * Class BillingInfoTest
 * @package Paytic\Omnipay\Librapay\Tests\Models\Order
 */
class BillingInfoTest extends AbstractTest
{
    public function testFromCard()
    {
        $parameters =
            [
                'billingFirstName' => 'John',
                'billingLastName'  => 'Doe',
            ];
        $card       = new CreditCard($parameters);

        $billing = BillingInfo::fromCard($card);

        self::assertSame($parameters['billingFirstName'] . ' ' . $parameters['billingLastName'], $billing->name);
    }
}