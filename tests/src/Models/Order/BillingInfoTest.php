<?php

namespace ByTIC\Omnipay\Librapay\Tests\Models\Order;

use ByTIC\Omnipay\Librapay\Models\Order\BillingInfo;
use ByTIC\Omnipay\Librapay\Tests\AbstractTest;
use Omnipay\Common\CreditCard;

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