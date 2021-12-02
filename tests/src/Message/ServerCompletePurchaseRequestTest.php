<?php

namespace Paytic\Omnipay\Librapay\Tests\Message;

use Guzzle\Http\Client as HttpClient;
use Paytic\Omnipay\Librapay\Message\ServerCompletePurchaseRequest;
use Paytic\Omnipay\Librapay\Message\ServerCompletePurchaseResponse;
use Paytic\Omnipay\Librapay\Tests\AbstractTest;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class ServerCompletePurchaseRequestTest
 * @package Paytic\Omnipay\Librapay\Tests\Message
 */
class ServerCompletePurchaseRequestTest extends AbstractTest
{
    public function testSend()
    {
        $response = $this->generateResponse('/requests/serverCompletePurchaseParams.php');

        self::assertTrue($response->isSuccessful());
        self::assertFalse($response->isPending());
        self::assertFalse($response->isCancelled());

        self::assertSame('00', $response->getCode());
        self::assertSame('Approved', $response->getMessage());
        self::assertSame('494108027545', $response->getTransactionReference());
        self::assertSame('100005', $response->getTransactionId());

        self::assertSame('100005', $response->getTransactionId());
        self::assertSame('1', $response->getContent());
    }

    public function test_timeout()
    {
        $response = $this->generateResponse('/requests/server_complete/timeout_params.php');

        self::assertFalse($response->isSuccessful());
        self::assertFalse($response->isPending());
        self::assertFalse($response->isCancelled());

        self::assertSame('990', $response->getCode());
        self::assertSame('Transaction timeout', $response->getMessage());
        self::assertSame(
            '<br />1:20F0B7B6839E7969D92B02E642FA74D696F7C734<br />2:88800236910618851240.00000399019Transaction timeout-41111411111420201011171601325b8ec8212f41b7251f9a335066466b350',
            $response->getContent()
        );
    }

    public function testSendInvalidPSign()
    {
        $client = $this->getHttpClient();
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

    protected function generateResponse($path)
    {
        $client = new HttpClient();
        $request = self::generateRequestFromFixtures(TEST_FIXTURE_PATH.$path);

        $request = new ServerCompletePurchaseRequest($client, $request);

        $parameters = require TEST_FIXTURE_PATH.DIRECTORY_SEPARATOR.'enviromentParams.php';
        $request->initialize($parameters);

        $response = $request->send();

        self::assertInstanceOf(ServerCompletePurchaseResponse::class, $response);

        return $response;
    }
}
