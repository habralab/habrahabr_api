<?php

    namespace tmtm\Habrahabr_api\Resources;

    use tmtm\Habrahabr_api\HttpAdapter\MockAdapter;
    use tmtm\Habrahabr_api\Resources\HubResource;

    class HubResourceTest extends \PHPUnit_Framework_TestCase
    {
        const BAD_ALIAS = 'f%ck';
        const BAD_ALIAS_EXCEPTION = 'bad alias - f%ck';

        protected $adapter;
        protected $hubResource;

        protected function setUp()
        {
            $this->adapter = new MockAdapter();
            $this->hubResource = new HubResource();
            $this->hubResource->setAdapter( $this->adapter );
        }

        public function testGetHubInfo()
        {
            // TODO
        }

        public function testGetHubInfoException()
        {
            $this->setExpectedException( 'tmtm\Habrahabr_api\Exception\IncorrectUsageException', self::BAD_ALIAS_EXCEPTION );
            $this->hubResource->getHubInfo( self::BAD_ALIAS );
        }

        public function testGetFeedHabred()
        {
            // TODO
        }

        public function testGetFeedHabredException()
        {
            $this->setExpectedException( 'tmtm\Habrahabr_api\Exception\IncorrectUsageException', self::BAD_ALIAS_EXCEPTION );
            $this->hubResource->getFeedHabred( self::BAD_ALIAS );
        }

        public function testGetFeedUnhabred()
        {
            // TODO
        }

        public function testGetFeedUnhabredException()
        {
            $this->setExpectedException( 'tmtm\Habrahabr_api\Exception\IncorrectUsageException', self::BAD_ALIAS_EXCEPTION );
            $this->hubResource->getFeedUnhabred( self::BAD_ALIAS );
        }

        public function testGetFeedNew()
        {
            // TODO
        }

        public function testGetFeedNewException()
        {
            $this->setExpectedException( 'tmtm\Habrahabr_api\Exception\IncorrectUsageException', self::BAD_ALIAS_EXCEPTION );
            $this->hubResource->getFeedNew( self::BAD_ALIAS );
        }
    }
