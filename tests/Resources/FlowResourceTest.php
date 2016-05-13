<?php

namespace Habrahabr\Tests\Api\Resources;

use Habrahabr\Tests\Api\HttpAdapter\MockAdapter;
use Habrahabr\Api\HttpAdapter\CurlAdapter;
use Habrahabr\Api\Resources\FlowResource;

class FlowResourceTest extends \PHPUnit_Framework_TestCase
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
            $fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/fixture_hub.json'), true);
            $this->fixtureHub = $fixture['data'];

            // Fixture Post Data
            $fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/fixture_post.json'), true);
            $this->fixturePost = $fixture['data'];
        }

        $this->resource = new FlowResource();
        $this->resource->setAdapter($this->adapter);
    }

    public function testGetFlows()
    {
        if ($this->mocking) {
            $expected = [
                'data' => [
                    [
                        'name' => 'Разработка',
                        'alias' => 'develop',
                        'hubs_count' => 239,
                        'url' => 'http://habrahabr.ru/flows/develop/',
                    ],
                ],
                'server_time' => '2016-04-14T16:38:27+03:00',
            ];

            $this->adapter->addGetHandler('/flows', $expected);
        }

        $actual = $this->resource->getFlows();

        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(1, count($actual['data']));

        $flow = array_pop($actual['data']);

        $this->assertArrayHasKey('name', $flow);
        $this->assertArrayHasKey('alias', $flow);
        $this->assertArrayHasKey('hubs_count', $flow);
        $this->assertArrayHasKey('url', $flow);
    }

    public function testGetFeedInteresting()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_page' => [
                    'url' => 'http://api.dev/v1/flows/develop/interesting?page=2',
                    'int' => 2
                ],
                'sorted_by' => 'time_published',
                'data' => [
                    $this->fixturePost,
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/flows/develop/interesting?page=1', $expected);
        }

        $actual = $this->resource->getFeedInteresting('develop');

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

    public function testGetFeedAll()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_page' => [
                    'url' => 'http://api.dev/v1/flows/develop/all?page=2',
                    'int' => 2
                ],
                'sorted_by' => 'time_published',
                'data' => [
                    $this->fixturePost,
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/flows/develop/all?page=1', $expected);
        }

        $actual = $this->resource->getFeedAll('develop');

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

    public function testGetFeedBest()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_page' => [
                    'url' => 'http://api.dev/v1/flows/develop/best?page=2',
                    'int' => 2
                ],
                'sorted_by' => 'time_published',
                'data' => [
                    $this->fixturePost,
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/flows/develop/best?page=1', $expected);
        }

        $actual = $this->resource->getFeedBest('develop');

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

    public function testGetHubList()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 6,
                'next_page' => [
                    'url' => 'http://api.dev/v1/flows/develop/hubs?page=3',
                    'int' => 3
                ],
                'data' => [
                    $this->fixtureHub,
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/flows/develop/hubs?page=2', $expected);
        }

        $actual = $this->resource->getHubList('develop', 2);

        $this->assertArrayHasKey('pages', $actual);
        $this->assertArrayHasKey('next_page', $actual);
        $this->assertArrayHasKey('url', $actual['next_page']);
        $this->assertArrayHasKey('int', $actual['next_page']);
        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));
    }
}
