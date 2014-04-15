<?php

    namespace tmtm\Habrahabr_api\Resources\Tests;

    use tmtm\Habrahabr_api\HttpAdapter\MockAdapter;
    use tmtm\Habrahabr_api\Resources\CompanyResource;

    class CompanyResourceTest extends \PHPUnit_Framework_TestCase
    {
        protected $adapter;
        protected $companyResource;

        protected function setUp()
        {
            $this->adapter = new MockAdapter();
            $this->companyResource = new CompanyResource();
            $this->companyResource->setAdapter( $this->adapter );
        }

        public function testGetCompanyPosts()
        {
            // TODO
        }

        public function testGetCompanyInfo()
        {
            // TODO
        }
    }
