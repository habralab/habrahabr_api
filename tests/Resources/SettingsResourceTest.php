<?php

namespace Habrahabr\Tests\Api\Resources;

use Habrahabr\Tests\Api\HttpAdapter\MockAdapter;
use Habrahabr\Api\HttpAdapter\CurlAdapter;
use Habrahabr\Api\Resources\SettingsResource;

class SettingsResourceTest extends \PHPUnit_Framework_TestCase
{
    protected $adapter;
    protected $resource;

    private $mocking = false;

    protected function setUp()
    {
        if (getenv('ENDPOINT')) {
            $this->adapter = new CurlAdapter();
            $this->adapter->setEndpoint(getenv('ENDPOINT'));
            $this->adapter->setToken(getenv('TOKEN'));
            $this->adapter->setClient(getenv('CLIENT'));
        } else {
            $this->mocking = true;
            $this->adapter = new MockAdapter();
        }

        $this->resource = new SettingsResource();
        $this->resource->setAdapter($this->adapter);
    }

    public function testAcceptAgreement()
    {
        $fixture = [
            'ok' => 1,
            'server_time' => '2016-04-15T13:12:45+03:00'
        ];

        $this->adapter = new MockAdapter();
        $this->adapter->addPutHandler('/settings/agreement', $fixture);
        $this->resource->setAdapter($this->adapter);

        $actual = $this->resource->acceptAgreement();

        $this->assertArrayHasKey('ok', $actual);
        $this->assertArrayHasKey('server_time', $actual);
    }
}
