<?php

require 'init.php';

$gateway = new \ByTIC\Omnipay\Librapay\Gateway();

$parameters = [
    'orderId' => 100005,
    'amount' => 2.56,
    'description' => 'Comanda online #100005',
    'card' => ['first_name' => 'Gabriel', 'last_name' => 'Solomon', 'email' => 'vladv63@yahoo.com'],
    'returnUrl' => 'register.42km.ro/testResponse.librapay.php',
    'notifyUrl' => '',
    'items' => [
        [
            'name' => 10,
            'price' => '5.00',
            'description' => 'Product 1 Desc',
            'quantity' => 2,
        ],
        [
            'name' => 'Ping Pong',
            'price' => '15.00',
            'description' => 'Product 2 Desc',
            'quantity' => 1,
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
