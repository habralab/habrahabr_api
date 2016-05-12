<?php

namespace Habrahabr\Tests\Api\Resources;

use Habrahabr\Tests\Api\HttpAdapter\MockAdapter;
use Habrahabr\Api\HttpAdapter\CurlAdapter;
use Habrahabr\Api\Resources\FeedResource;

class FeedResourceTest extends \PHPUnit_Framework_TestCase
{
    protected $adapter;
    protected $resource;

    private $mocking = false;

    private $fixturePost = [];

    protected function setUp()
    {
        if (getenv('ENDPOINT')) {
            $this->adapter = new CurlAdapter();
            $this->adapter->setEndpoint(getenv('ENDPOINT'));
            $this->adapter->setToken(getenv('TOKEN'));
            $this->adapter->setClient(getenv('CLIENT'));
        } else {
            $this->mocking = true;
            $this->adapter = new MockAdapter();

            // Fixture Post Data
            $fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/fixture_post.json'), true);
            $this->fixturePost = $fixture['data'];
        }

        $this->resource = new FeedResource();
        $this->resource->setAdapter($this->adapter);
    }

    public function testGetFeedHabred()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_page' => [
                    'url' => 'http://api.dev/v1/feed/habred?page=3',
                    'int' => 3
                ],
                'data' => [
                    $this->fixturePost,
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/feed/habred?page=2', $expected);
        }

        $actual = $this->resource->getFeedHabred(2);

        $this->assertArrayHasKey('pages', $actual);
        $this->assertArrayHasKey('next_page', $actual);
        $this->assertArrayHasKey('url', $actual['next_page']);
        $this->assertArrayHasKey('int', $actual['next_page']);
        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testGetFeedHabredFail()
    {
        $this->resource->getFeedHabred(-1);
    }

    public function testGetFeedUnhabred()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_page' => [
                    'url' => 'http://api.dev/v1/feed/unhabred?page=3',
                    'int' => 3
                ],
                'data' => [
                    $this->fixturePost,
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/feed/unhabred?page=2', $expected);
        }

        $actual = $this->resource->getFeedUnhabred(2);

        $this->assertArrayHasKey('pages', $actual);
        $this->assertArrayHasKey('next_page', $actual);
        $this->assertArrayHasKey('url', $actual['next_page']);
        $this->assertArrayHasKey('int', $actual['next_page']);
        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testGetFeedUnhabredFail()
    {
        $this->resource->getFeedUnhabred(-1);
    }

    public function testGetFeedNew()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_page' => [
                    'url' => 'http://api.dev/v1/feed/new?page=3',
                    'int' => 3
                ],
                'data' => [
                    $this->fixturePost,
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/feed/new?page=2', $expected);
        }

        $actual = $this->resource->getFeedNew(2);

        $this->assertArrayHasKey('pages', $actual);
        $this->assertArrayHasKey('next_page', $actual);
        $this->assertArrayHasKey('url', $actual['next_page']);
        $this->assertArrayHasKey('int', $actual['next_page']);
        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testGetFeedNewFail()
    {
        $this->resource->getFeedNew(-1);
    }
}
