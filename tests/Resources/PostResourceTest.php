<?php

namespace Habrahabr\Tests\Api\Resources;

use Habrahabr\Tests\Api\HttpAdapter\MockAdapter;
use Habrahabr\Api\HttpAdapter\CurlAdapter;
use Habrahabr\Api\Resources\PostResource;

class PostResourceTest extends \PHPUnit_Framework_TestCase
{
    protected $adapter;
    protected $resource;

    private $mocking = false;

    private $fixturePost = [];

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
            $this->fixturePost = json_decode(file_get_contents(__DIR__ . '/../Fixtures/fixture_post.json'), true);
        }

        $this->resource = new PostResource();
        $this->resource->setAdapter($this->adapter);
    }

    public function testGetPost()
    {
        if ($this->mocking) {
            $this->adapter->addGetHandler('/post/259787', $this->fixturePost);
        }

        $actual = $this->resource->getPost(259787);

        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);

        $this->assertArrayHasKey('id', $actual['data']);
        $this->assertArrayHasKey('time_published', $actual['data']);
        $this->assertArrayHasKey('time_interesting', $actual['data']);
        $this->assertArrayHasKey('title', $actual['data']);
        $this->assertArrayHasKey('preview_html', $actual['data']);
        $this->assertArrayHasKey('text_cut', $actual['data']);
        $this->assertArrayHasKey('text_html', $actual['data']);
        $this->assertArrayHasKey('url', $actual['data']);

        $this->assertArrayHasKey('score', $actual['data']);
        $this->assertArrayHasKey('vote', $actual['data']);
        $this->assertArrayHasKey('votes_count', $actual['data']);
        $this->assertArrayHasKey('reading_count', $actual['data']);
        $this->assertArrayHasKey('favorites_count', $actual['data']);
        $this->assertArrayHasKey('comments_count', $actual['data']);
        $this->assertArrayHasKey('comments_new', $actual['data']);
        $this->assertArrayHasKey('tags_string', $actual['data']);

        $this->assertArrayHasKey('hubs', $actual['data']);
        $this->assertInternalType('array', $actual['data']['hubs']);
        $this->assertGreaterThan(0, count($actual['data']['hubs']));

        $this->assertArrayHasKey('author', $actual['data']);
        $this->assertInternalType('array', $actual['data']['author']);
        $this->assertGreaterThan(0, count($actual['data']['author']));

        $this->assertArrayHasKey('has_polls', $actual['data']);
        $this->assertArrayHasKey('post_type', $actual['data']);
        $this->assertArrayHasKey('post_type_str', $actual['data']);
        $this->assertArrayHasKey('is_can_vote', $actual['data']);
        $this->assertArrayHasKey('is_habred', $actual['data']);
        $this->assertArrayHasKey('is_interesting', $actual['data']);
        $this->assertArrayHasKey('is_favorite', $actual['data']);
        $this->assertArrayHasKey('is_tutorial', $actual['data']);
        $this->assertArrayHasKey('is_recovery_mode', $actual['data']);
        $this->assertArrayHasKey('is_comments_hide', $actual['data']);
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testGetPostFail()
    {
        $this->resource->getPost(-1);
    }

    public function testVotePlus()
    {
        $fixtureVote = [
            'ok' => 1,
            'score' => 100,
            'server_time' => '2016-04-15T13:12:45+03:00'
        ];

        $this->adapter = new MockAdapter();
        $this->adapter->addPutHandler('/post/259787/vote', $fixtureVote);
        $this->resource->setAdapter($this->adapter);

        $actual = $this->resource->votePlus(259787);

        $this->assertArrayHasKey('ok', $actual);
        $this->assertArrayHasKey('score', $actual);
        $this->assertArrayHasKey('server_time', $actual);
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testVotePlusFail()
    {
        $this->resource->votePlus(-1);
    }

    public function testVoteNeutral()
    {
        $fixtureVote = [
            'ok' => 1,
            'score' => 100,
            'server_time' => '2016-04-15T13:12:45+03:00'
        ];

        $this->adapter = new MockAdapter();
        $this->adapter->addPutHandler('/post/259787/vote', $fixtureVote);
        $this->resource->setAdapter($this->adapter);

        $actual = $this->resource->voteNeutral(259787);

        $this->assertArrayHasKey('ok', $actual);
        $this->assertArrayHasKey('score', $actual);
        $this->assertArrayHasKey('server_time', $actual);
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testVoteNeutralFail()
    {
        $this->resource->voteNeutral(-1);
    }

    public function testVoteMinus()
    {
        $fixtureVote = [
            'ok' => 1,
            'score' => 100,
            'server_time' => '2016-04-15T13:12:45+03:00'
        ];

        $this->adapter = new MockAdapter();
        $this->adapter->addPutHandler('/post/259787/vote', $fixtureVote);
        $this->resource->setAdapter($this->adapter);

        $actual = $this->resource->voteMinus(259787);

        $this->assertArrayHasKey('ok', $actual);
        $this->assertArrayHasKey('score', $actual);
        $this->assertArrayHasKey('server_time', $actual);
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testVoteMinusFail()
    {
        $this->resource->voteMinus(-1);
    }

    public function testVoteFail()
    {
        $fixtureVote = [
            'code' => 400,
            'message' => 'Incorrect parameters',
            'additional' => [
                'Повторное голосование запрещено'
            ]
        ];

        $this->adapter = new MockAdapter();
        $this->adapter->addPutHandler('/post/259787/vote', $fixtureVote);
        $this->resource->setAdapter($this->adapter);

        $actual = $this->resource->voteNeutral(259787);

        $this->assertArrayHasKey('code', $actual);
        $this->assertArrayHasKey('message', $actual);
        $this->assertArrayHasKey('additional', $actual);
    }

    public function testAddPostToFavorite()
    {
        $fixtureVote = [
            'ok' => 1,
            'server_time' => '2016-04-15T13:12:45+03:00'
        ];

        $this->adapter = new MockAdapter();
        $this->adapter->addPutHandler('/post/290938/favorite', $fixtureVote);
        $this->resource->setAdapter($this->adapter);

        $actual = $this->resource->addPostToFavorite(290938);

        $this->assertArrayHasKey('ok', $actual);
        $this->assertArrayHasKey('server_time', $actual);
    }

    public function testRemovePostFromFavorite()
    {
        $fixtureVote = [
            'ok' => 1,
            'server_time' => '2016-04-15T13:12:45+03:00'
        ];

        $this->adapter = new MockAdapter();
        $this->adapter->addDeleteHandler('/post/290938/favorite', $fixtureVote);
        $this->resource->setAdapter($this->adapter);

        $actual = $this->resource->removePostFromFavorite(290938);

        $this->assertArrayHasKey('ok', $actual);
        $this->assertArrayHasKey('server_time', $actual);
    }
}
