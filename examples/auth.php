<?php

require_once __DIR__ . '/../vendor/autoload.php';

$adapter = new \Habrahabr\Api\HttpAdapter\CurlAdapter();
$adapter->setEndpoint(getenv('ENDPOINT'));
$adapter->setClient(getenv('CLIENT'));

$client = new \Habrahabr\Api\Client($adapter);

echo $client->getAuthorizationUrl('https://tmtm.ru/', 'token');
