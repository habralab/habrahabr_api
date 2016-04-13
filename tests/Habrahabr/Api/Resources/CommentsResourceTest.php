<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\HttpAdapter\MockAdapter;
use Habrahabr\Api\Resources\CommentsResource;

class CommentsResourceTest extends \PHPUnit_Framework_TestCase
{
    protected $adapter;
    protected $commentsResource;

    protected function setUp()
    {
        $this->adapter = new MockAdapter();
        $this->commentsResource = new CommentsResource();
        $this->commentsResource->setAdapter($this->adapter);
    }

    public function testGetCommentsForPost()
    {
        // TODO
    }

    public function testPostComment()
    {
        // TODO
    }
}
