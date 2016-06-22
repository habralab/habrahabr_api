<?php

namespace Habrahabr\Tests\Api\Resources;

use Habrahabr\Tests\Api\HttpAdapter\MockAdapter;
use Habrahabr\Api\HttpAdapter\CurlAdapter;
use Habrahabr\Api\Resources\PollResource;

class PollResourceTest extends \PHPUnit_Framework_TestCase
{
    protected $adapter;
    protected $resource;

    private $mocking = false;

    private $fixturePoll = [];

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
            $this->fixturePoll = json_decode(file_get_contents(__DIR__ . '/../Fixtures/fixture_poll.json'), true);
        }

        $this->resource = new PollResource();
        $this->resource->setAdapter($this->adapter);
    }

    public function testGetPoll()
    {
        if ($this->mocking) {
            $this->adapter->addGetHandler('/polls/8442', $this->fixturePoll);
        }

        $actual = $this->resource->getPoll(8442);

        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);

        $this->assertArrayHasKey('id', $actual['data']);
        $this->assertArrayHasKey('post_id', $actual['data']);
        $this->assertArrayHasKey('answers_type', $actual['data']);
        $this->assertArrayHasKey('time_elapsed', $actual['data']);
        $this->assertArrayHasKey('votes_count', $actual['data']);
        $this->assertArrayHasKey('pass_count', $actual['data']);
        $this->assertArrayHasKey('text', $actual['data']);
        $this->assertArrayHasKey('text_html', $actual['data']);
        $this->assertArrayHasKey('variants', $actual['data']);
        $this->assertArrayHasKey('can_vote', $actual['data']);

        $this->assertInternalType('array', $actual['data']['variants']);

        $variant = array_shift($actual['data']['variants']);
        $this->assertArrayHasKey('id', $variant);
        $this->assertArrayHasKey('post_id', $variant);
        $this->assertArrayHasKey('polling_question_id', $variant);
        $this->assertArrayHasKey('text', $variant);
        $this->assertArrayHasKey('text_html', $variant);
        $this->assertArrayHasKey('votes_count', $variant);
        $this->assertArrayHasKey('percent', $variant);
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testGetPollFail()
    {
        $this->resource->getPoll(-1);
    }

    public function testVote()
    {
        $fixtureVote = [
            'ok' => 1,
            'server_time' => '2016-04-15T13:12:45+03:00'
        ];

        $this->adapter = new MockAdapter();
        $this->adapter->addPutHandler('/polls/8442/vote', $fixtureVote);
        $this->resource->setAdapter($this->adapter);

        $actual = $this->resource->vote(8442, 76357);

        $this->assertArrayHasKey('ok', $actual);
        $this->assertArrayHasKey('server_time', $actual);
    }

    public function testVoteArray()
    {
        $fixtureVote = [
            'ok' => 1,
            'server_time' => '2016-04-15T13:12:45+03:00'
        ];

        $this->adapter = new MockAdapter();
        $this->adapter->addPutHandler('/polls/8442/vote', $fixtureVote);
        $this->resource->setAdapter($this->adapter);

        $actual = $this->resource->vote(8442, [76357, 76358]);

        $this->assertArrayHasKey('ok', $actual);
        $this->assertArrayHasKey('server_time', $actual);
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testVoteFail()
    {
        $this->resource->vote('foo');
    }
}
