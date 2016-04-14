<?php

namespace Habrahabr\Tests\Api\Resources;

use Habrahabr\Tests\Api\HttpAdapter\MockAdapter;
use Habrahabr\Api\Resources\UserResource;

class UserResourceTest extends \PHPUnit_Framework_TestCase
{
    protected $adapter;
    protected $userResource;

    protected function setUp()
    {
        $this->adapter = new MockAdapter();
        $this->userResource = new UserResource();
        $this->userResource->setAdapter($this->adapter);
    }

    public function testGetUser()
    {
        // TODO
    }

    public function testGetUsersList()
    {
        // TODO
    }

    public function testGetUserComments()
    {
        // TODO
    }

    public function testGetUserPosts()
    {
        // TODO
    }

    public function testGetUserHubs()
    {
        // TODO
    }

    public function testGetUserCompanies()
    {
        // TODO
    }

    public function testGetUserFollowers()
    {
        // TODO
    }

    public function testGetUserFollowed()
    {
        // TODO
    }

    public function testVoteKarmaPlus()
    {
        // TODO
    }

    public function testVoteKarmaMinus()
    {
        // TODO
    }

    public function testGetUserFavoritesPost()
    {
        // TODO
    }

    public function testGetUserFavoritesComments()
    {
        // TODO
    }
}
