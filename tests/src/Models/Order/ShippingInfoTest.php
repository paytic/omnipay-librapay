<?php

namespace Paytic\Omnipay\Librapay\Tests\Models\Order;

use Paytic\Omnipay\Librapay\Models\Order\ShippingInfo;
use Paytic\Omnipay\Librapay\Tests\AbstractTest;
use Omnipay\Common\CreditCard;

class ShippingInfoTest extends AbstractTest
{
    public function testFromCard()
    {
        $parameters =
            [
                'shippingFirstName' => 'John',
                'shippingLastName'  => 'Doe',
            ];
        $card       = new CreditCard($parameters);

        $info = ShippingInfo::fromCard($card);

        self::assertSame($parameters['shippingFirstName'] . ' ' . $parameters['shippingLastName'], $info->name);
    }
}