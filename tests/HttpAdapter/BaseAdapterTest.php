<?php

namespace Habrahabr\Tests\Api\HttpAdapter;

use Habrahabr\Api\HttpAdapter\BaseAdapter;

class MockBaseAdapter extends BaseAdapter
{

}

class BaseAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MockBaseAdapter
     */
    protected $adapter;

    protected function setUp()
    {
        $this->adapter = new MockBaseAdapter();
    }

    public function testSetApikey()
    {
        $this->adapter->setApikey('foobar');

        $this->assertAttributeContains('foobar', 'apikey', $this->adapter);
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testSetApikeyFail()
    {
        $this->adapter->setApikey('!@#');
    }

    public function testSetToken()
    {
        $this->adapter->setToken('foobar');

        $this->assertAttributeContains('foobar', 'token', $this->adapter);
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testSetTokenFail()
    {
        $this->adapter->setToken('!@#');
    }

    public function testSetClient()
    {
        $this->adapter->setClient('foo.bar');

        $this->assertAttributeContains('foo.bar', 'client', $this->adapter);
        $this->assertEquals('foo.bar', $this->adapter->getClient());
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testSetClientFail()
    {
        $this->adapter->setClient('foobar');
    }

    public function testSetEndpoint()
    {
        $this->adapter->setEndpoint('https://habrahabr.ru/');

        $this->assertAttributeContains('https://habrahabr.ru', 'endpoint', $this->adapter);
        $this->assertEquals('https://habrahabr.ru', $this->adapter->getEndpoint());
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testSetEndpointFail()
    {
        $this->adapter->setEndpoint('foobar');
    }

    public function testSetConnectionTimeout()
    {
        $this->adapter->setConnectionTimeout(100);

        $this->assertEquals(100, $this->adapter->getConnectionTimeout());
    }

    public function testCreateUrl()
    {
        $this->adapter->setEndpoint('https://habrahabr.ru/');

        $this->assertEquals('https://habrahabr.ru/foobar', $this->adapter->createUrl('/foobar'));
    }
}
