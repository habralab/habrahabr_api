<?php

require_once __DIR__ . '/../vendor/autoload.php';

$adapter = new \Habrahabr\Api\HttpAdapter\CurlAdapter();
$adapter->setStrictSSL(true);
$adapter->setEndpoint(getenv('ENDPOINT'));
$adapter->setToken(getenv('TOKEN'));
$adapter->setClient(getenv('CLIENT'));

$client = new \Habrahabr\Api\Client($adapter);

$flows = $client->getFlowResource()->getFlows();
var_dump($flows);

$FeedInteresting = $client->getFlowResource()->getFeedInteresting('develop', 2);
$FeedAll = $client->getFlowResource()->getFeedAll('develop', 2);
$FeedBest = $client->getFlowResource()->getFeedBest('develop', 2);

$hubs = $client->getFlowResource()->getHubList('develop');
var_dump($hubs);
