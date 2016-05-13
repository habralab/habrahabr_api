<?php

require_once __DIR__ . '/../vendor/autoload.php';

$adapter = new \Habrahabr\Api\HttpAdapter\CurlAdapter();
$adapter->setStrictSSL(true);
$adapter->setEndpoint(getenv('ENDPOINT'));
$adapter->setToken(getenv('TOKEN'));
$adapter->setClient(getenv('CLIENT'));

$client = new \Habrahabr\Api\Client($adapter);

$CommentsForPost = $client->getCommentsResource()->getCommentsForPost(2160);
var_dump($CommentsForPost);

$PostComment = $client->getCommentsResource()->postComment(2160, 'hello habr', 6706618);
var_dump($PostComment);

$vote = $client->getCommentsResource()->voteForComment('000', 1);
var_dump($vote);
