<?php

namespace Habrahabr\Tests\Api\Resources;

use Habrahabr\Tests\Api\HttpAdapter\MockAdapter;
use Habrahabr\Api\Resources\HubResource;

class HubResourceTest extends \PHPUnit_Framework_TestCase
{
    const BAD_ALIAS = 'f%ck';
    const BAD_ALIAS_EXCEPTION = 'bad alias - f%ck';

    protected $adapter;
    protected $hubResource;

    protected function setUp()
    {
        $this->adapter = new MockAdapter();
        $this->hubResource = new HubResource();
        $this->hubResource->setAdapter($this->adapter);
    }

    public function testGetHubInfo()
    {
        // TODO
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testGetHubInfoException()
    {
        $this->hubResource->getHubInfo(self::BAD_ALIAS);
    }

    public function testGetFeedHabred()
    {
        // TODO
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testGetFeedHabredException()
    {
        $this->hubResource->getFeedHabred(self::BAD_ALIAS);
    }

    public function testGetFeedUnhabred()
    {
        // TODO
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testGetFeedUnhabredException()
    {
        $this->hubResource->getFeedUnhabred(self::BAD_ALIAS);
    }

    public function testGetFeedNew()
    {
        // TODO
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testGetFeedNewException()
    {
        $this->hubResource->getFeedNew(self::BAD_ALIAS);
    }
}
