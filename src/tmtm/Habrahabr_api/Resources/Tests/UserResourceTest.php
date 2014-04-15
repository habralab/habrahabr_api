<?php

    namespace tmtm\Habrahabr_api\Resources\Tests;

    use tmtm\Habrahabr_api\HttpAdapter\MockAdapter;
    use tmtm\Habrahabr_api\Resources\UserResource;

    class UserResourceTest extends \PHPUnit_Framework_TestCase
    {
        protected $adapter;
        protected $userResource;

        protected function setUp()
        {
            $this->adapter = new MockAdapter();
            $this->userResource = new UserResource();
            $this->userResource->setAdapter( $this->adapter );
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
