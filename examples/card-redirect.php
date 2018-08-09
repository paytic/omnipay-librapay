<?php

require 'init.php';

$gateway = new \ByTIC\Omnipay\Librapay\Gateway();
$gateway->initialize(require TEST_FIXTURE_PATH . DIRECTORY_SEPARATOR. 'enviromentParams.php');

$parameters = require TEST_FIXTURE_PATH . '/simpleOrderParams.php';

foreach (['merchant', 'merchantName', 'merchantEmail', 'merchantUrl', 'terminal', 'key'] as $field) {
    $parameters[$field] = $_ENV['LIBRAPAY_' . strtoupper($field)];
}

$request = $gateway->purchase($parameters);
$response = $request->send();

// Send the Symfony HttpRedirectResponse
$response->send();
