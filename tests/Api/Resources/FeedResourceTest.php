<?php

namespace Habrahabr\Tests\Api\Resources;

use Habrahabr\Tests\Api\HttpAdapter\MockAdapter;
use Habrahabr\Api\Resources\FeedResource;

class FeedResourceTest extends \PHPUnit_Framework_TestCase
{
    protected $adapter;
    protected $feedResource;

    protected function setUp()
    {
        $this->adapter = new MockAdapter();
        $this->feedResource = new FeedResource();
        $this->feedResource->setAdapter($this->adapter);
    }

    public function testGetFeedHabred()
    {
        // TODO
    }

    public function testGetFeedUnhabred()
    {
        // TODO
    }

    public function testGetFeedNew()
    {
        // TODO
    }
}
