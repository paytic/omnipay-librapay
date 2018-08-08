<?php

$params = [];
foreach (['merchant', 'merchantName', 'merchantEmail', 'merchantUrl', 'terminal', 'key'] as $field) {
    $params[$field] = $_ENV['LIBRAPAY_' . strtoupper($field)];
}
return $params;