<?php

namespace Paytic\Omnipay\Librapay\Tests\Models\Order;

use Paytic\Omnipay\Librapay\Models\Order\CustomData;
use Paytic\Omnipay\Librapay\Tests\AbstractTest;

/**
 * Class CustomDataTest
 * @package Paytic\Omnipay\Librapay\Tests\Models\Order
 */
class CustomDataTest extends AbstractTest
{
    public function testToArray()
    {
        $customData = CustomData::fromParams([]);

        self::assertSame(
            [
                'ProductsData' => [],
                'UserData' => [
                    'LoginName' => null,
                    'Email' => null,
                    'Name' => null,
                    'Cnp' => null,
                    'Phone' => null,
                    'BillingName' => null,
                    'BillingID' => null,
                    'BillingIDNumber' => null,
                    'BillingIssuedBy' => null,
                    'BillingEmail' => null,
                    'BillingPhone' => null,
                    'BillingAddress' => null,
                    'BillingCity' => null,
                    'BillingPostalCode' => null,
                    'BillingDistrict' => null,
                    'BillingCountry' => null,
                    'ShippingName' => null,
                    'ShippingID' => null,
                    'ShippingIDNumber' => null,
                    'ShippingIssuedBy' => null,
                    'ShippingEmail' => null,
                    'ShippingPhone' => null,
                    'ShippingAddress' => null,
                    'ShippingCity' => null,
                    'ShippingPostalCode' => null,
                    'ShippingDistrict' => null,
                    'ShippingCountry' => null,
                ],
            ],
            $customData->toArray()
        );
    }
}
