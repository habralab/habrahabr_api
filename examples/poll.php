<?php

require_once __DIR__ . '/../vendor/autoload.php';

$adapter = new \Habrahabr\Api\HttpAdapter\CurlAdapter();
$adapter->setStrictSSL(true);
$adapter->setEndpoint(getenv('ENDPOINT'));
$adapter->setToken(getenv('TOKEN'));
$adapter->setClient(getenv('CLIENT'));

$client = new \Habrahabr\Api\Client($adapter);

$Poll = $client->getPollResource()->getPoll(15636);
$Vote = $client->getPollResource()->vote(15636, 76357);
$Vote = $client->getPollResource()->vote(15636, [76357, 76359]);
