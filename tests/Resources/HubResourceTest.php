<?php

namespace Habrahabr\Tests\Api\Resources;

use Habrahabr\Tests\Api\HttpAdapter\MockAdapter;
use Habrahabr\Api\HttpAdapter\CurlAdapter;
use Habrahabr\Api\Resources\HubResource;

class HubResourceTest extends \PHPUnit_Framework_TestCase
{
    protected $adapter;
    protected $resource;

    private $mocking = false;

    private $fixtureHub = [];
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

            // Fixture Hub Data
            $this->fixtureHub = json_decode(file_get_contents(__DIR__ . '/../Fixtures/fixture_hub.json'), true);

            // Fixture Post Data
            $fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/fixture_post.json'), true);
            $this->fixturePost = $fixture['data'];
        }

        $this->resource = new HubResource();
        $this->resource->setAdapter($this->adapter);
    }

    public function testGetHubInfo()
    {
        if ($this->mocking) {
            $this->adapter->addGetHandler('/hub/yii/info', $this->fixtureHub);
        }

        $actual = $this->resource->getHubInfo('yii');

        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);

        $this->assertArrayHasKey('alias', $actual['data']);
        $this->assertArrayHasKey('title', $actual['data']);
        $this->assertArrayHasKey('about', $actual['data']);
        $this->assertArrayHasKey('count_posts', $actual['data']);
        $this->assertArrayHasKey('count_subscribers', $actual['data']);
        $this->assertArrayHasKey('rating', $actual['data']);
        $this->assertArrayHasKey('tags_string', $actual['data']);
        $this->assertArrayHasKey('is_profiled', $actual['data']);
        $this->assertArrayHasKey('is_membership', $actual['data']);
        $this->assertArrayHasKey('is_company', $actual['data']);
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testGetHubInfoFail()
    {
        $this->resource->getHubInfo('');
    }

    public function testGetFeedHabred()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_page' => [
                    'url' => 'http://api.dev/v1/hub/yii/unhabred?page=2',
                    'int' => 3
                ],
                'sorted_by' => 'time_published',
                'data' => [
                    $this->fixturePost,
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/hub/yii/habred?page=1', $expected);
        }

        $actual = $this->resource->getFeedHabred('yii');

        $this->assertArrayHasKey('pages', $actual);
        $this->assertArrayHasKey('next_page', $actual);
        $this->assertArrayHasKey('url', $actual['next_page']);
        $this->assertArrayHasKey('int', $actual['next_page']);
        $this->assertArrayHasKey('sorted_by', $actual);
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
        $this->resource->getFeedHabred('');
    }

    public function testGetFeedUnhabred()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_page' => [
                    'url' => 'http://api.dev/v1/hub/yii/unhabred?page=2',
                    'int' => 3
                ],
                'sorted_by' => 'time_published',
                'data' => [
                    $this->fixturePost,
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/hub/yii/unhabred?page=1', $expected);
        }

        $actual = $this->resource->getFeedUnhabred('yii');

        $this->assertArrayHasKey('pages', $actual);
        $this->assertArrayHasKey('next_page', $actual);
        $this->assertArrayHasKey('url', $actual['next_page']);
        $this->assertArrayHasKey('int', $actual['next_page']);
        $this->assertArrayHasKey('sorted_by', $actual);
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
        $this->resource->getFeedUnhabred('');
    }

    public function testGetFeedNew()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_page' => [
                    'url' => 'http://api.dev/v1/hub/yii/unhabred?page=2',
                    'int' => 3
                ],
                'data' => [
                    $this->fixturePost,
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/hub/yii/new?page=1', $expected);
        }

        $actual = $this->resource->getFeedNew('yii');

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
        $this->resource->getFeedNew('');
    }

    public function testGetHubList()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_link' => [
                    'url' => 'http://api.dev/v1/hubs?page=3',
                    'int' => 3
                ],
                'data' => [
                    $this->fixtureHub,
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/hubs?page=2', $expected);
        }

        $actual = $this->resource->getHubList(2);

        $this->assertArrayHasKey('pages', $actual);
        $this->assertArrayHasKey('next_link', $actual);
        $this->assertArrayHasKey('url', $actual['next_link']);
        $this->assertArrayHasKey('int', $actual['next_link']);
        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testGetHubListFail()
    {
        $this->resource->getHubList(-1);
    }

    public function testSubscribeHub()
    {
        $fixture = [
            'ok' => 1,
            'server_time' => '2016-04-15T13:12:45+03:00'
        ];

        $this->adapter = new MockAdapter();
        $this->adapter->addPutHandler('/hub/yii', $fixture);
        $this->resource->setAdapter($this->adapter);

        $actual = $this->resource->subscribeHub('yii');

        $this->assertArrayHasKey('ok', $actual);
        $this->assertArrayHasKey('server_time', $actual);
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testSubscribeHubFail()
    {
        $this->resource->subscribeHub('');
    }

    public function testUnsubscribeHub()
    {
        $fixture = [
            'ok' => 1,
            'server_time' => '2016-04-15T13:12:45+03:00'
        ];

        $this->adapter = new MockAdapter();
        $this->adapter->addDeleteHandler('/hub/yii', $fixture);
        $this->resource->setAdapter($this->adapter);

        $actual = $this->resource->unsubscribeHub('yii');

        $this->assertArrayHasKey('ok', $actual);
        $this->assertArrayHasKey('server_time', $actual);
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testUnsubscribeHubFail()
    {
        $this->resource->unsubscribeHub('');
    }
}
