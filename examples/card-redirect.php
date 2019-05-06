<?php

require 'init.php';

$gateway = new \ByTIC\Omnipay\Librapay\Gateway();
$gateway->initialize(require TEST_FIXTURE_PATH . DIRECTORY_SEPARATOR. 'enviromentParams.php');
//$gateway->setTestMode(false);

$parameters = require TEST_FIXTURE_PATH . '/simpleOrderParams.php';

$request = $gateway->purchase($parameters);
$response = $request->send();

// Send the Symfony HttpRedirectResponse
$response->send();
