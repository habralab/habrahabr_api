<?php

require_once __DIR__ . '/../vendor/autoload.php';

$adapter = new \Habrahabr\Api\HttpAdapter\CurlAdapter();
$adapter->setStrictSSL(true);
$adapter->setEndpoint(getenv('ENDPOINT'));
$adapter->setToken(getenv('TOKEN'));
$adapter->setClient(getenv('CLIENT'));

$client = new \Habrahabr\Api\Client($adapter);

$HubInfo = $client->getHubResource()->getHubInfo('php');
$HubHabred = $client->getHubResource()->getFeedHabred('php', 2);
$HubUnhabred = $client->getHubResource()->getFeedUnhabred('php', 2);
$HubNew = $client->getHubResource()->getFeedNew('php');

$hubs = $client->getHubResource()->getHubList();
var_dump($hubs);

$hubs = $client->getHubResource()->subscribeHub('php');
var_dump($hubs);

$hubs = $client->getHubResource()->unsubscribeHub('php');
var_dump($hubs);
