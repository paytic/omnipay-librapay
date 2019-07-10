<?php

namespace ByTIC\Omnipay\Librapay\Tests\Message;

use ByTIC\Omnipay\Librapay\Message\ServerCompletePurchaseRequest;
use ByTIC\Omnipay\Librapay\Message\ServerCompletePurchaseResponse;
use ByTIC\Omnipay\Librapay\Tests\AbstractTest;
use Guzzle\Http\Client as HttpClient;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class ServerCompletePurchaseRequestTest
 * @package ByTIC\Omnipay\Librapay\Tests\Message
 */
class ServerCompletePurchaseRequestTest extends AbstractTest
{

    public function testSend()
    {
        $response = $this->generateResponse('/requests/serverCompletePurchaseParams.php');

        self::assertTrue($response->isSuccessful());
        self::assertFalse($response->isPending());
        self::assertFalse($response->isCancelled());

        self::assertSame('00',$response->getCode());
        self::assertSame('Approved',$response->getMessage());
        self::assertSame('494108027545',$response->getTransactionReference());
        self::assertSame('100005',$response->getTransactionId());

        self::assertSame('100005',$response->getTransactionId());
        self::assertSame('1',$response->getContent());
    }



    protected function generateResponse($path)
    {
        $client = new HttpClient();
        $request = self::generateRequestFromFixtures(TEST_FIXTURE_PATH . $path);

        $request = new ServerCompletePurchaseRequest($client, $request);

        $parameters = require TEST_FIXTURE_PATH . DIRECTORY_SEPARATOR. 'enviromentParams.php';
        $request->initialize($parameters);

        $response = $request->send();

        self::assertInstanceOf(ServerCompletePurchaseResponse::class, $response);
        return $response;
    }

    public function testSendInvalidPSign()
    {
        $client = new HttpClient();
        $request = HttpRequest::createFromGlobals();

        $request = self::generateRequestFromFixtures(TEST_FIXTURE_PATH . '/requests/completePurchaseParams.php');
        $request->request->set('P_SIGN', $request->request->get('P_SIGN'). '11');

        $request = new ServerCompletePurchaseRequest($client, $request);

        $parameters = require TEST_FIXTURE_PATH . DIRECTORY_SEPARATOR. 'enviromentParams.php';
        $request->initialize($parameters);

        $response = $request->send();

        self::assertInstanceOf(ServerCompletePurchaseResponse::class, $response);

        self::assertFalse($response->isSuccessful());
        self::assertFalse($response->isPending());
        self::assertFalse($response->isCancelled());
        self::assertEmpty($response->getDataProperty('notification'));
    }
}
