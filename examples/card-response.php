<?php

require 'init.php';

$gateway = new \ByTIC\Omnipay\Librapay\Gateway();
$gateway->initialize(require TEST_FIXTURE_PATH . DIRECTORY_SEPARATOR. 'enviromentParams.php');

$request = $gateway->completePurchase([]);
$response = $request->send();

var_dump($response->isSuccessful());