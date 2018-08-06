<?php

require 'init.php';

$gateway = new \ByTIC\Omnipay\Librapay\Gateway();

$parameters = [
    'orderId' => 100005,
    'amount' => 3.49,
    'description' => 'Comanda online #100005',
    'card' => ['first_name' => 'Gabriel', 'last_name' => 'Solomon', 'email' => 'vladv63@yahoo.com'],
    'returnUrl' => 'register.42km.ro/testResponse.librapay.php',
    'notifyUrl' => '',
    'items' => [
        [
            'name' => 'Paine',
            'price' => '1.25',
            'description' => 'Paine de casa',
            'quantity' => 1,
        ],
        [
            'name' => 'Paine2',
            'price' => '1.12',
            'description' => 'Product 2 Desc',
            'quantity' => 2,
        ],
    ],
];

foreach (['merchant', 'merchantName', 'merchantUrl', 'terminal', 'key'] as $field) {
    $parameters[$field] = $_ENV['LIBRAPAY_'.strtoupper($field)];
}

$request = $gateway->purchase($parameters);
$response = $request->send();

// Send the Symfony HttpRedirectResponse
$response->send();
