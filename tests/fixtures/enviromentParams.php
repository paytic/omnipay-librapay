<?php

$params = [];
foreach (['merchant', 'merchantName', 'merchantEmail', 'merchantUrl', 'terminal', 'key'] as $field) {
    $params[$field] = getenv('LIBRAPAY_' . strtoupper($field));
}
return $params;