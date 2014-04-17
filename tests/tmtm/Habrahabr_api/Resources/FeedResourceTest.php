<?php

    namespace tmtm\Habrahabr_api\Resources;

    use tmtm\Habrahabr_api\HttpAdapter\MockAdapter;
    use tmtm\Habrahabr_api\Resources\FeedResource;

    class FeedResourceTest extends \PHPUnit_Framework_TestCase
    {
        protected $adapter;
        protected $feedResource;

        protected function setUp()
        {
            $this->adapter = new MockAdapter();
            $this->feedResource = new FeedResource();
            $this->feedResource->setAdapter( $this->adapter );
        }

        public function testGetFeedHabred()
        {
            // TODO
        }

        public function testGetFeedUnhabred()
        {
            // TODO
        }

        public function testGetFeedNew()
        {
            // TODO
        }
    }
