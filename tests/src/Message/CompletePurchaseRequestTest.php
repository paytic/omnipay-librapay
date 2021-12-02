<?php

namespace Paytic\Omnipay\Librapay\Tests\Message;

use Paytic\Omnipay\Librapay\Message\CompletePurchaseRequest;
use Paytic\Omnipay\Librapay\Message\CompletePurchaseResponse;
use Paytic\Omnipay\Librapay\Tests\AbstractTest;
use Guzzle\Http\Client as HttpClient;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class CompletePurchaseRequestTest
 * @package Paytic\Omnipay\Librapay\Tests\Message
 */
class CompletePurchaseRequestTest extends AbstractTest
{
    public function testSendSuccessful()
    {
        $response = $this->generateResponse('/requests/completePurchaseParams.php');

        self::assertTrue($response->isSuccessful());
        self::assertFalse($response->isPending());
        self::assertFalse($response->isCancelled());
        self::assertFalse($response->isPending());

        self::assertSame('00', $response->getCode());
        self::assertSame('Approved', $response->getMessage());
        self::assertSame('494108027545', $response->getTransactionReference());
        self::assertSame('100005', $response->getTransactionId());
    }

    public function testSendSuccessful2()
    {
        $response = $this->generateResponse('/requests/completePurchaseParams2.php');

        self::assertTrue($response->isSuccessful());
        self::assertFalse($response->isPending());
        self::assertFalse($response->isCancelled());
        self::assertFalse($response->isPending());

        self::assertSame('00', $response->getCode());
        self::assertSame('Approved', $response->getMessage());
        self::assertSame('919184259632', $response->getTransactionReference());
        self::assertSame('138877', $response->getTransactionId());
    }

    /**
     * @param $path
     * @return CompletePurchaseResponse
     */
    protected function generateResponse($path)
    {
        $client = $this->getHttpClient();
        $request = self::generateRequestFromFixtures(TEST_FIXTURE_PATH . $path);

        $request = new CompletePurchaseRequest($client, $request);

        $parameters = require TEST_FIXTURE_PATH . DIRECTORY_SEPARATOR. 'enviromentParams.php';
        $request->initialize($parameters);

        $response = $request->send();

        self::assertInstanceOf(CompletePurchaseResponse::class, $response);

        return $response;
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
