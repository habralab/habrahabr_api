<?php

namespace Habrahabr\Tests\Api\Resources;

use Habrahabr\Tests\Api\HttpAdapter\MockAdapter;
use Habrahabr\Api\HttpAdapter\CurlAdapter;
use Habrahabr\Api\Resources\UserResource;

class UserResourceTest extends \PHPUnit_Framework_TestCase
{
    protected $adapter;
    protected $resource;

    private $mocking = false;

    private $fixtureUser = [];
    private $fixturePost = [];
    private $fixtureHub = [];
    private $fixtureCompany = [];

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

            // Fixture User Data
            $this->fixtureUser = json_decode(file_get_contents(__DIR__ . '/../Fixtures/fixture_user.json'), true);

            // Fixture Post Data
            $fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/fixture_post.json'), true);
            $this->fixturePost = $fixture['data'];

            // Fixture Hub Data
            $fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/fixture_hub.json'), true);
            $this->fixtureHub = $fixture['data'];

            // Fixture Company Data
            $fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/fixture_company.json'), true);
            $this->fixtureCompany = $fixture['data'];
        }

        $this->resource = new UserResource();
        $this->resource->setAdapter($this->adapter);
    }

    public function testGetUser()
    {
        if ($this->mocking) {
            $this->adapter->addGetHandler('/users/habrahabr', $this->fixtureUser);
        }

        $actual = $this->resource->getUser('habrahabr');

        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));

        $this->assertArrayHasKey('id', $actual['data']);
        $this->assertArrayHasKey('login', $actual['data']);
        $this->assertArrayHasKey('time_registered', $actual['data']);
        $this->assertArrayHasKey('score', $actual['data']);
        $this->assertArrayHasKey('fullname', $actual['data']);
        $this->assertArrayHasKey('sex', $actual['data']);
        $this->assertArrayHasKey('rating', $actual['data']);
        $this->assertArrayHasKey('vote', $actual['data']);
        $this->assertArrayHasKey('rating_position', $actual['data']);
        $this->assertArrayHasKey('geo', $actual['data']);
        $this->assertArrayHasKey('counters', $actual['data']);
        $this->assertArrayHasKey('badges', $actual['data']);
        $this->assertArrayHasKey('avatar', $actual['data']);
        $this->assertArrayHasKey('is_readonly', $actual['data']);
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testGetUserFail()
    {
        $this->resource->getUser('');
    }

    public function testGetUsersList()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_page' => [
                    'url' => 'http://api.dev/v1/users?page=2',
                    'int' => 2
                ],
                'data' => [
                    $this->fixtureUser,
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/users?page=1', $expected);
        }

        $actual = $this->resource->getUsersList();

        $this->assertArrayHasKey('pages', $actual);
        $this->assertArrayHasKey('next_page', $actual);
        $this->assertArrayHasKey('url', $actual['next_page']);
        $this->assertArrayHasKey('int', $actual['next_page']);
        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));
    }

    public function testGetUserComments()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_page' => [
                    'url' => 'http://api.dev/v1/users/habrahabr/comments?page=2',
                    'int' => 2
                ],
                'data' => [
                    [
                        'id' => 8838322,
                        'parent_id' => 0,
                        'level' => 0,
                        'message' => 'Comment message',
                        'time_published' => '2016-04-04T12:42:50+03:00',
                        'score' => 2,
                        'time_changed' => 0,
                        'author' => [
                            'login' => 'habrahabr',
                        ],
                        'avatar' => 'https://habrastorage.org/....jpg',
                        'is_can_vote' => false,
                        'vote' => false
                    ]
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/users/habrahabr/comments?page=1', $expected);
        }

        $actual = $this->resource->getUserComments('habrahabr');

        $this->assertArrayHasKey('pages', $actual);
        $this->assertArrayHasKey('next_page', $actual);
        $this->assertArrayHasKey('url', $actual['next_page']);
        $this->assertArrayHasKey('int', $actual['next_page']);
        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));

        $comment = array_pop($actual['data']);

        $this->assertArrayHasKey('id', $comment);
        $this->assertArrayHasKey('score', $comment);
        $this->assertArrayHasKey('time_published', $comment);
        $this->assertArrayHasKey('message', $comment);
        $this->assertArrayHasKey('parent_id', $comment);
        $this->assertArrayHasKey('level', $comment);
        $this->assertArrayHasKey('time_changed', $comment);
        $this->assertArrayHasKey('author', $comment);
        $this->assertArrayHasKey('login', $comment['author']);
        $this->assertArrayHasKey('avatar', $comment);
        $this->assertArrayHasKey('is_can_vote', $comment);
        $this->assertArrayHasKey('vote', $comment);
    }

    public function testGetUserPosts()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_page' => [
                    'url' => 'http://api.dev/v1/users/habrahabr/posts?page=2',
                    'int' => 2
                ],
                'sorted_by' => 'time_published',
                'author' => $this->fixtureUser,
                'data' => [
                    $this->fixturePost
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/users/habrahabr/posts?page=1', $expected);
        }

        $actual = $this->resource->getUserPosts('habrahabr');

        $this->assertArrayHasKey('pages', $actual);
        $this->assertArrayHasKey('next_page', $actual);
        $this->assertArrayHasKey('url', $actual['next_page']);
        $this->assertArrayHasKey('int', $actual['next_page']);
        $this->assertArrayHasKey('sorted_by', $actual);
        $this->assertArrayHasKey('author', $actual);
        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['author']);
        $this->assertGreaterThanOrEqual(0, count($actual['author']));
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));
    }

    public function testGetUserHubs()
    {
        if ($this->mocking) {
            $expected = [
                'data' => [
                    $this->fixtureHub
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/users/habrahabr/hubs', $expected);
        }

        $actual = $this->resource->getUserHubs('habrahabr');

        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));
    }

    public function testGetUserCompanies()
    {
        if ($this->mocking) {
            $expected = [
                'data' => [
                    $this->fixtureCompany
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/users/habrahabr/companies', $expected);
        }

        $actual = $this->resource->getUserCompanies('habrahabr');

        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));
    }

    public function testGetUserFollowers()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_page' => [
                    'url' => 'http://api.dev/v1/users/habrahabr/followers?page=2',
                    'int' => 2
                ],
                'data' => [
                    $this->fixtureUser
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/users/habrahabr/followers?page=1', $expected);
        }

        $actual = $this->resource->getUserFollowers('habrahabr');

        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));
    }

    public function testGetUserFollowed()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_page' => [
                    'url' => 'http://api.dev/v1/users/habrahabr/followers?page=2',
                    'int' => 2
                ],
                'data' => [
                    $this->fixtureUser
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/users/deniskin/followed?page=1', $expected);
        }

        $actual = $this->resource->getUserFollowed('deniskin');

        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));
    }

    public function testVoteKarmaPlus()
    {
        $fixture = [
            'ok' => 1,
            'server_time' => '2016-04-15T13:12:45+03:00'
        ];

        $this->adapter = new MockAdapter();
        $this->adapter->addPutHandler('/users/habrahabr/vote', $fixture);
        $this->resource->setAdapter($this->adapter);

        $actual = $this->resource->voteKarmaPlus('habrahabr');

        $this->assertArrayHasKey('ok', $actual);
        $this->assertArrayHasKey('server_time', $actual);
    }

    public function testVoteKarmaMinus()
    {
        $fixture = [
            'ok' => 1,
            'server_time' => '2016-04-15T13:12:45+03:00'
        ];

        $this->adapter = new MockAdapter();
        $this->adapter->addDeleteHandler('/users/habrahabr/vote', $fixture);
        $this->resource->setAdapter($this->adapter);

        $actual = $this->resource->voteKarmaMinus('habrahabr');

        $this->assertArrayHasKey('ok', $actual);
        $this->assertArrayHasKey('server_time', $actual);
    }

    public function testGetUserFavoritesPost()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_page' => [
                    'url' => 'http://api.dev/v1/users/habrahabr/favorites/posts?page=2',
                    'int' => 2
                ],
                'sorted_by' => 'time_favorited',
                'data' => [
                    $this->fixturePost
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/users/habrahabr/favorites/posts?page=1', $expected);
        }

        $actual = $this->resource->getUserFavoritesPost('habrahabr');

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

    public function testGetUserFavoritesComments()
    {
        if ($this->mocking) {
            $expected = [
                'data' => [
                    [
                        'id' => 8838322,
                        'parent_id' => 0,
                        'level' => 0,
                        'message' => 'Comment message',
                        'time_published' => '2016-04-04T12:42:50+03:00',
                        'score' => 2,
                        'time_changed' => 0,
                        'author' => [
                            'login' => 'habrahabr',
                        ],
                        'avatar' => 'https://habrastorage.org/....jpg',
                        'is_can_vote' => false,
                        'vote' => false
                    ]
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/users/habrahabr/favorites/comments?page=1', $expected);
        }

        $actual = $this->resource->getUserFavoritesComments('habrahabr');

        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));
    }
}
