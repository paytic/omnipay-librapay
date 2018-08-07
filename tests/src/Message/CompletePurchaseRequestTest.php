<?php

namespace ByTIC\Omnipay\Librapay\Tests\Message;

use ByTIC\Omnipay\Librapay\Message\CompletePurchaseRequest;
use ByTIC\Omnipay\Librapay\Message\CompletePurchaseResponse;
use ByTIC\Omnipay\Librapay\Tests\AbstractTest;
use Guzzle\Http\Client as HttpClient;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class CompletePurchaseRequestTest
 * @package ByTIC\Omnipay\Librapay\Tests\Message
 */
class CompletePurchaseRequestTest extends AbstractTest
{

    public function testSend()
    {
        $client = new HttpClient();
        $request = HttpRequest::createFromGlobals();
        $parameters = require TEST_FIXTURE_PATH . DIRECTORY_SEPARATOR. 'completePurchaseParams.php';
        $request->query->replace($parameters);
        $request = new CompletePurchaseRequest($client, $request);

        $parameters = [];
        foreach (['merchant', 'merchantName', 'merchantEmail', 'merchantUrl', 'terminal', 'key'] as $field) {
            $parameters[$field] = $_ENV['LIBRAPAY_' . strtoupper($field)];
        }
        $request->initialize($parameters);

        $response = $request->send();

        self::assertInstanceOf(CompletePurchaseResponse::class, $response);

        self::assertTrue($response->isSuccessful());
        self::assertFalse($response->isPending());
        self::assertFalse($response->isCancelled());

        self::assertSame('00',$response->getCode());
        self::assertSame('Approved',$response->getMessage());
        self::assertSame('494108027545',$response->getTransactionReference());
        self::assertSame('100005',$response->getTransactionId());
    }

    /**
     * @return CompletePurchaseRequest
     */
    protected function newPurchaseRequest()
    {
        $client = new HttpClient();
        $request = HttpRequest::createFromGlobals();
        $request = new CompletePurchaseRequest($client, $request);
        return $request;
    }
}
