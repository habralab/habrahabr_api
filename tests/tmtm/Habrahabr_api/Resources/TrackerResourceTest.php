<?php

    namespace tmtm\Habrahabr_api\Resources;

    use tmtm\Habrahabr_api\HttpAdapter\MockAdapter;
    use tmtm\Habrahabr_api\Resources\TrackerResource;

    class TrackerResourceTest extends \PHPUnit_Framework_TestCase
    {
        const BAD_TITLE = 1488;
        const BAD_TITLE_EXCEPTION = 'title or text invalid';
        const BAD_TEXT = 1234567890;
        const BAD_TEXT_EXCEPTION = 'title or text invalid';
        const BAD_TITLE_AND_TEXT_EXCEPTION = 'title or text invalid';
        const GOOD_TITLE = 'Такси в город и загород недорого';
        const GOOD_TEXT = '<u>Уникальное</u> <b>спец</b> <i>предложение</i>!';

        protected $adapter;
        protected $trackerResource;

        protected function setUp()
        {
            $this->adapter = new MockAdapter();
            $this->trackerResource = new TrackerResource();
            $this->trackerResource->setAdapter( $this->adapter );
        }

        public function testPush()
        {
            // TODO
        }

        public function testPushExceptionTitle()
        {
            $this->setExpectedException( 'tmtm\Habrahabr_api\Exception\IncorrectUsageException', self::BAD_TITLE_EXCEPTION );
            $this->trackerResource->push( self::BAD_TITLE, self::GOOD_TEXT );
        }

        public function testPushExceptionText()
        {
            $this->setExpectedException( 'tmtm\Habrahabr_api\Exception\IncorrectUsageException', self::BAD_TEXT_EXCEPTION );
            $this->trackerResource->push( self::GOOD_TITLE, self::BAD_TEXT );
        }

        public function testPushExceptionTitleAndText()
        {
            $this->setExpectedException( 'tmtm\Habrahabr_api\Exception\IncorrectUsageException', self::BAD_TITLE_AND_TEXT_EXCEPTION );
            $this->trackerResource->push( self::BAD_TITLE, self::BAD_TEXT );
        }

        public function testGetCounters()
        {
            // TODO
        }

        public function testGetPostsFeed()
        {
            // TODO
        }

        public function testGetSubscribersFeed()
        {
            // TODO
        }

        public function testGetMentions()
        {
            // TODO
        }

        public function testGetAppsFeed()
        {
            // TODO
        }
    }
