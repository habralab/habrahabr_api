<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\HttpAdapter\MockAdapter;
use Habrahabr\Api\Resources\SearchResource;

class SearchResourceTest extends \PHPUnit_Framework_TestCase
{
    protected $adapter;
    protected $searchResource;

    protected function setUp()
    {
        $this->adapter = new MockAdapter();
        $this->searchResource = new SearchResource();
        $this->searchResource->setAdapter($this->adapter);
    }

    public function testSearchPosts()
    {
        // TODO
    }

    public function testSearchUsers()
    {
        // TODO
    }
}
