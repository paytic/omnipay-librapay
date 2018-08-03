<?php

require 'init.php';

$gateway = new \ByTIC\Omnipay\Librapay\Gateway();

$parameters = [
    'orderId' => 99999,
    'amount' => 20.00,
    'card' => ['first_name' => 'Gabriel','last_name' => 'Solomon'],
];

foreach (['merchant','terminal','key'] as $field) {
    $parameters[$field] = $_ENV['LIBRAPAY_'.strtoupper($field)];
}

$request = $gateway->purchase($parameters);
$response = $request->send();

// Send the Symfony HttpRedirectResponse
$response->send();
