<?php

require_once __DIR__ . '/../vendor/autoload.php';

$adapter = new \Habrahabr\Api\HttpAdapter\CurlAdapter();
$adapter->setStrictSSL(true);
$adapter->setEndpoint(getenv('ENDPOINT'));
$adapter->setApikey(getenv('APIKEY'));


$client = new \Habrahabr\Api\Client($adapter);

$flows = $client->getFlowResource()->getFlows();
var_dump($flows);
