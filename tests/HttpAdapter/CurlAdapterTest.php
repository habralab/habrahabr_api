<?php

namespace Habrahabr\Tests\Api\HttpAdapter;

use Habrahabr\Api\HttpAdapter\CurlAdapter;

class MockCurlAdapter extends CurlAdapter
{
    protected function request($url, $method, array $params = [])
    {
        return $method . $url;
    }
}

class CurlAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MockCurlAdapter
     */
    protected $adapter;

    protected function setUp()
    {
        $this->adapter = new MockCurlAdapter();
        $this->adapter->setEndpoint('https://habrahabr.ru/');
    }

    public function testConstructDestruct()
    {
        $this->assertInstanceOf('\Habrahabr\Api\HttpAdapter\CurlAdapter', $this->adapter);
        $this->adapter = null;
        $this->assertNull($this->adapter);
    }

    public function testGet()
    {
        $actual = $this->adapter->get('/foobar');
        $this->assertEquals('GEThttps://habrahabr.ru/foobar', $actual);
    }

    public function testPost()
    {
        $actual = $this->adapter->post('/foobar');
        $this->assertEquals('POSThttps://habrahabr.ru/foobar', $actual);
    }

    public function testPut()
    {
        $actual = $this->adapter->put('/foobar');
        $this->assertEquals('PUThttps://habrahabr.ru/foobar', $actual);
    }

    public function testDelete()
    {
        $actual = $this->adapter->delete('/foobar');
        $this->assertEquals('DELETEhttps://habrahabr.ru/foobar', $actual);
    }

    public function testSetStrictSSL()
    {
        $this->assertAttributeEquals(true, 'strictSSL', $this->adapter);
        $this->adapter->setStrictSSL(false);
        $this->assertAttributeEquals(false, 'strictSSL', $this->adapter);
    }
}
