<?php

namespace ByTIC\Omnipay\Librapay\Tests\Message;

use ByTIC\Omnipay\Librapay\Message\ServerCompletePurchaseRequest;
use ByTIC\Omnipay\Librapay\Message\ServerCompletePurchaseResponse;
use ByTIC\Omnipay\Librapay\Tests\AbstractTest;
use Guzzle\Http\Client as HttpClient;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class ServerCompletePurchaseResponseTest
 * @package ByTIC\Omnipay\Librapay\Tests\Message
 */
class ServerCompletePurchaseResponseTest extends AbstractTest
{

    public function testSendRrn0()
    {
        $request = new ServerCompletePurchaseRequest(new HttpClient(), new HttpRequest());
        $response = new ServerCompletePurchaseResponse($request, [
            'notification' => ['rc' => '00']
        ]);

        self::assertTrue($response->isSuccessful());
        self::assertFalse($response->isPending());
        self::assertFalse($response->isCancelled());

        self::assertSame('1', $response->getContent());
    }

    public function testSendActionEmptyNotification()
    {
        $request = new ServerCompletePurchaseRequest(new HttpClient(), new HttpRequest());
        $response = new ServerCompletePurchaseResponse($request, [
            'string' => 'aaa',
            'p_string' => 'bbb',
            'notification' => []
        ]);

        self::assertFalse($response->isSuccessful());
        self::assertFalse($response->isPending());
        self::assertFalse($response->isCancelled());

        self::assertSame('<br />1:bbb<br />2:aaa0', $response->getContent());
    }
}
