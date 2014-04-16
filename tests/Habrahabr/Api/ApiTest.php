<?php

    namespace Habrahabr\Api;

    use Habrahabr\Api\Api;
    use Habrahabr\Api\HttpAdapter\MockAdapter;

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
            $this->assertInstanceOf( 'Habrahabr\Api\Resources\UserResource', $userResource );
        }

        public function testGetSearchResource()
        {
            $searchResource = $this->api->getSearchResource();
            $this->assertInstanceOf( 'Habrahabr\Api\Resources\SearchResource', $searchResource );
        }

        public function testGetPostResource()
        {
            $postResource = $this->api->getPostResource();
            $this->assertInstanceOf( 'Habrahabr\Api\Resources\PostResource', $postResource );
        }

        public function testGetHubResource()
        {
            $hubResource = $this->api->getHubResource();
            $this->assertInstanceOf( 'Habrahabr\Api\Resources\HubResource', $hubResource );
        }

        public function testGetFeedResource()
        {
            $feedResource = $this->api->getFeedResource();
            $this->assertInstanceOf( 'Habrahabr\Api\Resources\FeedResource', $feedResource );
        }

        public function testGetCompanyResource()
        {
            $companyResource = $this->api->getCompanyResource();
            $this->assertInstanceOf( 'Habrahabr\Api\Resources\CompanyResource', $companyResource );
        }

        public function testGetCommentsResource()
        {
            $commentsResource = $this->api->getCommentsResource();
            $this->assertInstanceOf( 'Habrahabr\Api\Resources\CommentsResource', $commentsResource );
        }

        public function testGetTrackerResource()
        {
            $trackerResource = $this->api->getTrackerResource();
            $this->assertInstanceOf( 'Habrahabr\Api\Resources\TrackerResource', $trackerResource );
        }
    }
