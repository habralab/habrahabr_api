<?php

require_once __DIR__ . '/../vendor/autoload.php';

$adapter = new \Habrahabr\Api\HttpAdapter\CurlAdapter();
$adapter->setStrictSSL(true);
$adapter->setEndpoint(getenv('ENDPOINT'));
$adapter->setToken(getenv('TOKEN'));
$adapter->setClient(getenv('CLIENT'));

$client = new \Habrahabr\Api\Client($adapter);

$User = $client->getUserResource()->getUser('me');
var_dump($User);

$User = $client->getUserResource()->getUser('habrahabr');
var_dump($User);

$Users = $client->getUserResource()->getUsersList(2);
$UserComments = $client->getUserResource()->getUserComments('habrahabr');
$UserPosts = $client->getUserResource()->getUserPosts('habrahabr');
$UserHubs = $client->getUserResource()->getUserHubs('habrahabr');
$UserCompanies = $client->getUserResource()->getUserCompanies('habrahabr');
$UserFollowers = $client->getUserResource()->getUserFollowers('habrahabr');
$UserFollowed = $client->getUserResource()->getUserFollowed('habrahabr');

$voteKarmaPlus = $client->getUserResource()->voteKarmaPlus('habrahabr');
var_dump($voteKarmaPlus);

$voteKarmaMinus = $client->getUserResource()->voteKarmaMinus('habrahabr');
var_dump($voteKarmaMinus);
