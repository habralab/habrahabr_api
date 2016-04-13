<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\HttpAdapter\MockAdapter;
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

    public function testGetHubInfoException()
    {
        $this->setExpectedException('Habrahabr\Api\Exception\IncorrectUsageException', self::BAD_ALIAS_EXCEPTION);
        $this->hubResource->getHubInfo(self::BAD_ALIAS);
    }

    public function testGetFeedHabred()
    {
        // TODO
    }

    public function testGetFeedHabredException()
    {
        $this->setExpectedException('Habrahabr\Api\Exception\IncorrectUsageException', self::BAD_ALIAS_EXCEPTION);
        $this->hubResource->getFeedHabred(self::BAD_ALIAS);
    }

    public function testGetFeedUnhabred()
    {
        // TODO
    }

    public function testGetFeedUnhabredException()
    {
        $this->setExpectedException('Habrahabr\Api\Exception\IncorrectUsageException', self::BAD_ALIAS_EXCEPTION);
        $this->hubResource->getFeedUnhabred(self::BAD_ALIAS);
    }

    public function testGetFeedNew()
    {
        // TODO
    }

    public function testGetFeedNewException()
    {
        $this->setExpectedException('Habrahabr\Api\Exception\IncorrectUsageException', self::BAD_ALIAS_EXCEPTION);
        $this->hubResource->getFeedNew(self::BAD_ALIAS);
    }
}
