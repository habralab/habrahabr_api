<?php

namespace Habrahabr\Tests\Api\Resources;

use Habrahabr\Tests\Api\HttpAdapter\MockAdapter;
use Habrahabr\Api\HttpAdapter\CurlAdapter;
use Habrahabr\Api\Resources\CompanyResource;

class CompanyResourceTest extends \PHPUnit_Framework_TestCase
{
    protected $adapter;
    protected $resource;

    private $mocking = false;

    private $fixturePost = [];
    private $fixtureCompany = [];

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

            // Fixture Post Data
            $fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/fixture_post.json'), true);
            $this->fixturePost = $fixture['data'];

            // Fixture Company Data
            $fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/fixture_company.json'), true);
            $this->fixtureCompany = $fixture['data'];
        }

        $this->resource = new CompanyResource();
        $this->resource->setAdapter($this->adapter);
    }
    public function testGetCompanyPosts()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_page' => [
                    'url' => 'http://api.dev/v1/company/tm?page=3',
                    'int' => 3
                ],
                'sorted_by' => 'time_published',
                'data' => [
                    $this->fixturePost,
                ],
                'company' => [
                    $this->fixtureCompany,
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/company/tm?page=2', $expected);
        }

        $actual = $this->resource->getCompanyPosts('tm', 2);

        $this->assertArrayHasKey('pages', $actual);
        $this->assertArrayHasKey('next_page', $actual);
        $this->assertArrayHasKey('url', $actual['next_page']);
        $this->assertArrayHasKey('int', $actual['next_page']);
        $this->assertArrayHasKey('sorted_by', $actual);
        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('company', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));
        $this->assertInternalType('array', $actual['company']);
        $this->assertGreaterThanOrEqual(0, count($actual['company']));
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testGetCompanyPostsFail()
    {
        $this->resource->getCompanyInfo('');
    }

    public function testGetCompanyInfo()
    {
        if ($this->mocking) {
            $expected = [
                'data' => $this->fixtureCompany,
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/company/tm/info', $expected);
        }

        $actual = $this->resource->getCompanyInfo('tm');

        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));

        $this->assertArrayHasKey('id', $actual['data']);
        $this->assertArrayHasKey('alias', $actual['data']);
        $this->assertArrayHasKey('url', $actual['data']);
        $this->assertArrayHasKey('name', $actual['data']);
        $this->assertArrayHasKey('director', $actual['data']);
        $this->assertArrayHasKey('rating', $actual['data']);
        $this->assertArrayHasKey('rating_position', $actual['data']);
        $this->assertArrayHasKey('score', $actual['data']);
        $this->assertArrayHasKey('description', $actual['data']);
        $this->assertArrayHasKey('fans_count', $actual['data']);
        $this->assertArrayHasKey('workers_count', $actual['data']);
        $this->assertArrayHasKey('is_fan', $actual['data']);
        $this->assertArrayHasKey('icon', $actual['data']);
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testGetCompanyInfoFail()
    {
        $this->resource->getCompanyInfo('');
    }

    public function testGetList()
    {
        if ($this->mocking) {
            $expected = [
                'pages' => 10,
                'next_link' => [
                    'url' => 'http://api.dev/v1/companies?page=2',
                    'int' => 3
                ],
                'data' => [
                    $this->fixtureCompany,
                ],
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/companies?page=1', $expected);
        }

        $actual = $this->resource->getList(1);

        $this->assertArrayHasKey('pages', $actual);
        $this->assertArrayHasKey('next_link', $actual);
        $this->assertArrayHasKey('url', $actual['next_link']);
        $this->assertArrayHasKey('int', $actual['next_link']);
        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testGetListFail()
    {
        $this->resource->getList(-1);
    }
}
