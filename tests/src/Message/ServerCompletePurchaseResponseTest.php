<?php

namespace Paytic\Omnipay\Librapay\Tests\Message;

use Paytic\Omnipay\Librapay\Message\ServerCompletePurchaseRequest;
use Paytic\Omnipay\Librapay\Message\ServerCompletePurchaseResponse;
use Paytic\Omnipay\Librapay\Tests\AbstractTest;
use Guzzle\Http\Client as HttpClient;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class ServerCompletePurchaseResponseTest
 * @package Paytic\Omnipay\Librapay\Tests\Message
 */
class ServerCompletePurchaseResponseTest extends AbstractTest
{

    public function testSendRrn0()
    {
        $request = new ServerCompletePurchaseRequest($this->getHttpClient(), new HttpRequest());
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
        $request = new ServerCompletePurchaseRequest($this->getHttpClient(), new HttpRequest());
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
