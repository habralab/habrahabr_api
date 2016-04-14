<?php

namespace Habrahabr\Tests\Api\Resources;

use Habrahabr\Tests\Api\HttpAdapter\MockAdapter;
use Habrahabr\Api\HttpAdapter\CurlAdapter;
use Habrahabr\Api\Resources\SearchResource;

class SearchResourceTest extends \PHPUnit_Framework_TestCase
{
    protected $adapter;
    protected $resource;

    protected $mocking = false;

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
        }

        $this->resource = new SearchResource();
        $this->resource->setAdapter($this->adapter);
    }

    public function testSearchPosts()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_page' => [
                    'url' => 'http://api.dotzero.devhabr.net/v1/search/posts/php?page=3',
                    'int' => 3
                ],
                'data' => [
                    // posts data
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/search/posts/php?page=2', $expected);
        }

        $actual = $this->resource->searchPosts('php', 2);

        $this->assertArrayHasKey('pages', $actual);
        $this->assertArrayHasKey('next_page', $actual);
        $this->assertArrayHasKey('url', $actual['next_page']);
        $this->assertArrayHasKey('int', $actual['next_page']);
        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
    }

    public function testSearchUsers()
    {
        if ($this->mocking) {
            $expected = [
                'pages'       => 10,
                'next_page'   => [
                    'url' => 'http://api.dotzero.devhabr.net/v1/search/users/habrahabr?page=3',
                    'int' => 3
                ],
                'data'        => [
                    // users data
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/search/users/habrahabr?page=2', $expected);
        }

        $actual = $this->resource->searchUsers('habrahabr', 2);

        $this->assertArrayHasKey('pages', $actual);
        $this->assertArrayHasKey('next_page', $actual);
        $this->assertArrayHasKey('url', $actual['next_page']);
        $this->assertArrayHasKey('int', $actual['next_page']);
        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
    }

    public function testSearchHubs()
    {
        if ($this->mocking) {
            $expected = [
                'data'        => [
                    // hubs data
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/hubs/search/php', $expected);
        }

        $actual = $this->resource->searchHubs('php');

        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
    }
}
