<?php

namespace Habrahabr\Tests\Api\Resources;

use Habrahabr\Tests\Api\HttpAdapter\MockAdapter;
use Habrahabr\Api\HttpAdapter\CurlAdapter;
use Habrahabr\Api\Resources\TrackerResource;

class TrackerResourceTest extends \PHPUnit_Framework_TestCase
{
    protected $adapter;
    protected $resource;

    private $mocking = false;

    private $fixturePost = [];
    private $fixtureUser = [];

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

            // Fixture User Data
            $fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/fixture_user.json'), true);
            $this->fixtureUser = $fixture['data'];
        }

        $this->resource = new TrackerResource();
        $this->resource->setAdapter($this->adapter);
    }

    public function testPush()
    {
        $fixture = [
            'ok' => 1,
            'server_time' => '2016-04-15T13:12:45+03:00'
        ];

        $this->adapter = new MockAdapter();
        $this->adapter->addPutHandler('/tracker', $fixture);
        $this->resource->setAdapter($this->adapter);

        $actual = $this->resource->push('Title', 'Message body');

        $this->assertArrayHasKey('ok', $actual);
        $this->assertArrayHasKey('server_time', $actual);
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testPushFail()
    {
        $this->resource->push(null, null);
    }

    public function testGetCounters()
    {
        if ($this->mocking) {
            $expected = [
                'total' => 38,
                'posts' => 21,
                'subscribers' => 10,
                'mentions' => 6,
                'apps' => 1,
                'server_time' => '2016-04-15T15:56:12+03:00'
            ];

            $this->adapter->addGetHandler('/tracker/counters', $expected);
        }

        $actual = $this->resource->getCounters();

        $this->assertArrayHasKey('total', $actual);
        $this->assertArrayHasKey('posts', $actual);
        $this->assertArrayHasKey('subscribers', $actual);
        $this->assertArrayHasKey('mentions', $actual);
        $this->assertArrayHasKey('apps', $actual);
        $this->assertArrayHasKey('server_time', $actual);
    }

    public function testGetPostsFeed()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_url' => [
                    'url' => 'http://api.dev/v1/tracker/posts?page=2',
                    'int' => 2
                ],
                'data' => [
                    $this->fixturePost,
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/tracker/posts', $expected);
        }

        $actual = $this->resource->getPostsFeed();

        $this->assertArrayHasKey('pages', $actual);
        $this->assertArrayHasKey('next_url', $actual);
        $this->assertArrayHasKey('url', $actual['next_url']);
        $this->assertArrayHasKey('int', $actual['next_url']);
        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));
    }

    public function testGetSubscribersFeed()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_url' => [
                    'url' => 'http://api.dev/v1/tracker/subscribers?page=2',
                    'int' => 2
                ],
                'data' => [
                    [
                        'action' => $this->fixturePost,
                        'action_owner' => $this->fixtureUser,
                        'activity_desc' => 'add_favorite_post',
                        'activity_type' => 4,
                        'is_shown' => 1,
                    ]
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/tracker/subscribers', $expected);
        }

        $actual = $this->resource->getSubscribersFeed();

        $this->assertArrayHasKey('pages', $actual);
        $this->assertArrayHasKey('next_url', $actual);
        $this->assertArrayHasKey('url', $actual['next_url']);
        $this->assertArrayHasKey('int', $actual['next_url']);
        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));
    }

    public function testGetMentions()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_url' => [
                    'url' => 'http://api.dev/v1/tracker/mentions?page=2',
                    'int' => 2
                ],
                'data' => [
                    [
                        'author' => $this->fixtureUser,
                        'activity_type' => 3,
                        'is_shown' => 1,
                        'comment' => [],
                    ]
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/tracker/mentions', $expected);
        }

        $actual = $this->resource->getMentions();

        $this->assertArrayHasKey('pages', $actual);
        $this->assertArrayHasKey('next_url', $actual);
        $this->assertArrayHasKey('url', $actual['next_url']);
        $this->assertArrayHasKey('int', $actual['next_url']);
        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));
    }

    public function testGetAppsFeed()
    {
        if ($this->mocking) {
            $expected = [
                'data' => [
                    [
                        'client' => [
                            'id' => 1,
                            'title' => 'Habrahabr iOS App'
                        ],
                        'title' => 'Title',
                        'text' => 'Message body',
                        'time_activity' => '2016-04-15T15:50:10+03:00',
                        'is_showed' => 1,
                        'key' => 'b96c4a1f37005e77fc72e7a2371ad87',
                    ]
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/tracker/apps', $expected);
        }

        $actual = $this->resource->getAppsFeed();

        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));

        if (count($actual['data'])) {
            $message = array_pop($actual['data']);

            $this->assertArrayHasKey('client', $message);
            $this->assertArrayHasKey('id', $message['client']);
            $this->assertArrayHasKey('title', $message['client']);
            $this->assertArrayHasKey('title', $message);
            $this->assertArrayHasKey('text', $message);
            $this->assertArrayHasKey('time_activity', $message);
            $this->assertArrayHasKey('is_showed', $message);
            $this->assertArrayHasKey('key', $message);
        }
    }
}
