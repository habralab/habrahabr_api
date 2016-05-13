<?php

require_once __DIR__ . '/../vendor/autoload.php';

$adapter = new \Habrahabr\Api\HttpAdapter\CurlAdapter();
$adapter->setStrictSSL(true);
$adapter->setEndpoint(getenv('ENDPOINT'));
$adapter->setToken(getenv('TOKEN'));
$adapter->setClient(getenv('CLIENT'));

$client = new \Habrahabr\Api\Client($adapter);

$CompanyPosts = $client->getCompanyResource()->getCompanyPosts('yandex');
$CompanyInfo = $client->getCompanyResource()->getCompanyInfo('yandex');
print_r($CompanyInfo);
    