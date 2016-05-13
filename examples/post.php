<?php

require_once __DIR__ . '/../vendor/autoload.php';

$adapter = new \Habrahabr\Api\HttpAdapter\CurlAdapter();
$adapter->setStrictSSL(true);
$adapter->setEndpoint(getenv('ENDPOINT'));
$adapter->setToken(getenv('TOKEN'));
$adapter->setClient(getenv('CLIENT'));

$client = new \Habrahabr\Api\Client($adapter);

$Post = $client->getPostResource()->getPost(2160);
$VotePost = $client->getPostResource()->vote(2160, 1);
$FavoritePost = $client->getPostResource()->addPostToFavorite(2160);
$unFavoritePost = $client->getPostResource()->removePostFromFavorite(2160);
