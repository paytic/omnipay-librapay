<?php

namespace ByTIC\Omnipay\Librapay\Tests\Models\Order;

use ByTIC\Omnipay\Librapay\Models\Order\CustomData;
use ByTIC\Omnipay\Librapay\Tests\AbstractTest;

class CustomDataTest extends AbstractTest
{
    public function testToArray()
    {
        $customData = new CustomData();

        self::assertSame([], $customData->toArray());
    }
}