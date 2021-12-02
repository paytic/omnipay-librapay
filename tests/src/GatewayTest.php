<?php

namespace Paytic\Omnipay\Librapay\Tests;

use Paytic\Omnipay\Librapay\Gateway;
use Guzzle\Http\Client;
use Http\Discovery\Psr17FactoryDiscovery;

/**
 * Class GatewayTest
 * @package Paytic\Omnipay\Librapay\Tests
 */
class GatewayTest extends AbstractTest
{
    public function testPurchase()
    {
        $httpClient = $this->getHttpClientReal();
        $gateway = new Gateway($httpClient);

        $params = require TEST_FIXTURE_PATH . DIRECTORY_SEPARATOR. 'enviromentParams.php';
        $gateway->initialize($params);

        $orderData = require TEST_FIXTURE_PATH . DIRECTORY_SEPARATOR. 'simpleOrderParams.php';
        $request = $gateway->purchase($orderData);
        $response = $request->send();

        $body = $response->getRedirectData();
        $headers = [];
        if ($response->getRedirectMethod() == 'POST') {
            $headers['Content-Type'] = 'application/x-www-form-urlencoded; charset=utf-8';
            $body = Psr17FactoryDiscovery::findStreamFactory()->createStream(http_build_query($body, '', '&'));
        }

        $gatewayResponse = $httpClient->request(
            $response->getRedirectMethod(),
            $response->getRedirectUrl(),
            $headers,
            $body
        );

        self::assertSame(200, $gatewayResponse->getStatusCode());
        $htmlGateway = $gatewayResponse->getBody()->__toString();

        self::assertContains('Date comanda', $htmlGateway);
        self::assertContains('Suma de plata:', $htmlGateway);
        self::assertContains($orderData['amount'], $htmlGateway);
    }
}
