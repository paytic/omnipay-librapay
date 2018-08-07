<?php

return [
    'orderId' => 100006,
    'amount' => 3.49,
    'description' => 'Comanda online #100006',
    'card' => [
        'first_name' => 'Gabriel',
        'last_name' => 'Solomon',
        'email' => 'solomongaby@yahoo.com',
        'phone' => '0741.040.219'
    ],
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
    ]
];