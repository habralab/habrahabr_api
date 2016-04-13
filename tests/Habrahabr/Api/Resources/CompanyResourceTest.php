<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\HttpAdapter\MockAdapter;
use Habrahabr\Api\Resources\CompanyResource;

class CompanyResourceTest extends \PHPUnit_Framework_TestCase
{
    protected $adapter;
    protected $companyResource;

    protected function setUp()
    {
        $this->adapter = new MockAdapter();
        $this->companyResource = new CompanyResource();
        $this->companyResource->setAdapter($this->adapter);
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
