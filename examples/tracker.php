<?php

require_once __DIR__ . '/../vendor/autoload.php';

$adapter = new \Habrahabr\Api\HttpAdapter\CurlAdapter();
$adapter->setStrictSSL(true);
$adapter->setEndpoint(getenv('ENDPOINT'));
$adapter->setToken(getenv('TOKEN'));
$adapter->setClient(getenv('CLIENT'));

$client = new \Habrahabr\Api\Client($adapter);

$counters = $client->getTrackerResource()->getCounters();
$posts = $client->getTrackerResource()->getPostsFeed();
$subs = $client->getTrackerResource()->getSubscribersFeed();
$apps = $client->getTrackerResource()->getAppsFeed();

$mentions = $client->getTrackerResource()->getMentions();
var_dump($mentions);

