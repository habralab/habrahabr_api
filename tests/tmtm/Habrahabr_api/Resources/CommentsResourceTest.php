<?php

    namespace tmtm\Habrahabr_api\Resources;

    use tmtm\Habrahabr_api\HttpAdapter\MockAdapter;
    use tmtm\Habrahabr_api\Resources\CommentsResource;

    class CommentsResourceTest extends \PHPUnit_Framework_TestCase
    {
        protected $adapter;
        protected $commentsResource;

        protected function setUp()
        {
            $this->adapter = new MockAdapter();
            $this->commentsResource = new CommentsResource();
            $this->commentsResource->setAdapter( $this->adapter );
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
