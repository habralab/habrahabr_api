<?php

    namespace tmtm\Habrahabr_api;

    use tmtm\Habrahabr_api\Api;
    use tmtm\Habrahabr_api\HttpAdapter\MockAdapter;

    class ApiTest extends \PHPUnit_Framework_TestCase
    {
        protected $api;

        protected function setUp()
        {
            $adapter = new MockAdapter();
            $this->api = new Api( $adapter );
        }

        public function testGetUserResource()
        {
            $userResource = $this->api->getUserResource();
            $this->assertInstanceOf( 'tmtm\Habrahabr_api\Resources\UserResource', $userResource );
        }

        public function testGetSearchResource()
        {
            $searchResource = $this->api->getSearchResource();
            $this->assertInstanceOf( 'tmtm\Habrahabr_api\Resources\SearchResource', $searchResource );
        }

        public function testGetPostResource()
        {
            $postResource = $this->api->getPostResource();
            $this->assertInstanceOf( 'tmtm\Habrahabr_api\Resources\PostResource', $postResource );
        }

        public function testGetHubResource()
        {
            $hubResource = $this->api->getHubResource();
            $this->assertInstanceOf( 'tmtm\Habrahabr_api\Resources\HubResource', $hubResource );
        }

        public function testGetFeedResource()
        {
            $feedResource = $this->api->getFeedResource();
            $this->assertInstanceOf( 'tmtm\Habrahabr_api\Resources\FeedResource', $feedResource );
        }

        public function testGetCompanyResource()
        {
            $companyResource = $this->api->getCompanyResource();
            $this->assertInstanceOf( 'tmtm\Habrahabr_api\Resources\CompanyResource', $companyResource );
        }

        public function testGetCommentsResource()
        {
            $commentsResource = $this->api->getCommentsResource();
            $this->assertInstanceOf( 'tmtm\Habrahabr_api\Resources\CommentsResource', $commentsResource );
        }

        public function testGetTrackerResource()
        {
            $trackerResource = $this->api->getTrackerResource();
            $this->assertInstanceOf( 'tmtm\Habrahabr_api\Resources\TrackerResource', $trackerResource );
        }
    }
