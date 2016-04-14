<?php

namespace Habrahabr\Tests\Api\Resources;

use Habrahabr\Tests\Api\HttpAdapter\MockAdapter;
use Habrahabr\Api\Resources\TrackerResource;

class TrackerResourceTest extends \PHPUnit_Framework_TestCase
{
    const BAD_TITLE = 1488;
    const BAD_TITLE_EXCEPTION = 'Push failed: Title or Text is not string';
    const BAD_TEXT = 1234567890;
    const BAD_TEXT_EXCEPTION = 'Push failed: Title or Text is not string';
    const BAD_TITLE_AND_TEXT_EXCEPTION = 'Push failed: Title or Text is not string';
    const GOOD_TITLE = 'Такси в город и загород недорого';
    const GOOD_TEXT = '<u>Уникальное</u> <b>спец</b> <i>предложение</i>!';

    protected $adapter;
    protected $trackerResource;

    protected function setUp()
    {
        $this->adapter = new MockAdapter();
        $this->trackerResource = new TrackerResource();
        $this->trackerResource->setAdapter($this->adapter);
    }

    public function testPush()
    {
        // TODO
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testPushExceptionTitle()
    {
        $this->trackerResource->push(self::BAD_TITLE, self::GOOD_TEXT);
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testPushExceptionText()
    {
        $this->trackerResource->push(self::GOOD_TITLE, self::BAD_TEXT);
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testPushExceptionTitleAndText()
    {
        $this->trackerResource->push(self::BAD_TITLE, self::BAD_TEXT);
    }

    public function testGetCounters()
    {
        // TODO
    }

    public function testGetPostsFeed()
    {
        // TODO
    }

    public function testGetSubscribersFeed()
    {
        // TODO
    }

    public function testGetMentions()
    {
        // TODO
    }

    public function testGetAppsFeed()
    {
        // TODO
    }
}
