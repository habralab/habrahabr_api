<?php

namespace Habrahabr\Api;

use Habrahabr\Api\Client;
use Habrahabr\Api\HttpAdapter\MockAdapter;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /** @var Client */
    protected $client;

    protected function setUp()
    {
        $adapter = new MockAdapter();
        $this->client = new Client($adapter);
    }

    public function testGetUserResource()
    {
        $userResource = $this->client->getUserResource();
        $this->assertInstanceOf('Habrahabr\Api\Resources\UserResource', $userResource);
    }

    public function testGetSearchResource()
    {
        $searchResource = $this->client->getSearchResource();
        $this->assertInstanceOf('Habrahabr\Api\Resources\SearchResource', $searchResource);
    }

    public function testGetPostResource()
    {
        $postResource = $this->client->getPostResource();
        $this->assertInstanceOf('Habrahabr\Api\Resources\PostResource', $postResource);
    }

    public function testGetHubResource()
    {
        $hubResource = $this->client->getHubResource();
        $this->assertInstanceOf('Habrahabr\Api\Resources\HubResource', $hubResource);
    }

    public function testGetFeedResource()
    {
        $feedResource = $this->client->getFeedResource();
        $this->assertInstanceOf('Habrahabr\Api\Resources\FeedResource', $feedResource);
    }

    public function testGetCompanyResource()
    {
        $companyResource = $this->client->getCompanyResource();
        $this->assertInstanceOf('Habrahabr\Api\Resources\CompanyResource', $companyResource);
    }

    public function testGetCommentsResource()
    {
        $commentsResource = $this->client->getCommentsResource();
        $this->assertInstanceOf('Habrahabr\Api\Resources\CommentsResource', $commentsResource);
    }

    public function testGetTrackerResource()
    {
        $trackerResource = $this->client->getTrackerResource();
        $this->assertInstanceOf('Habrahabr\Api\Resources\TrackerResource', $trackerResource);
    }
}
