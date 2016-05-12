<?php

namespace Habrahabr\Tests\Api\Resources;

use Habrahabr\Tests\Api\HttpAdapter\MockAdapter;
use Habrahabr\Api\HttpAdapter\CurlAdapter;
use Habrahabr\Api\Resources\CommentsResource;

class CommentsResourceTest extends \PHPUnit_Framework_TestCase
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

        $this->resource = new CommentsResource();
        $this->resource->setAdapter($this->adapter);
    }

    public function testGetCommentsForPost()
    {
        if ($this->mocking) {
            $expected = [
                'data' => [
                    [
                        'id' => 8660961,
                        'score' => 0,
                        'time_published' => '2015-11-20T18:08:29+03:00',
                        'message' => 'Сделайте пожалуйста, фильтр',
                        'parent_id' => 0,
                        'level' => 0,
                        'time_changed' => 0,
                        'author' => [
                            'login' => 'User',
                        ],
                        'avatar' => '//habrastorage.org/...small.jpg',
                        'is_can_vote' => true,
                        'vote' => false,
                    ],
                ],
                'last' => 8660961,
                'server_time' => '2016-04-14T16:38:27+03:00'
            ];

            $this->adapter->addGetHandler('/comments/259787', $expected);
        }

        $actual = $this->resource->getCommentsForPost(259787);

        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('last', $actual);
        $this->assertArrayHasKey('server_time', $actual);
        $this->assertInternalType('array', $actual['data']);
        $this->assertGreaterThanOrEqual(0, count($actual['data']));

        $comment = array_pop($actual['data']);

        $this->assertArrayHasKey('id', $comment);
        $this->assertArrayHasKey('score', $comment);
        $this->assertArrayHasKey('time_published', $comment);
        $this->assertArrayHasKey('message', $comment);
        $this->assertArrayHasKey('parent_id', $comment);
        $this->assertArrayHasKey('level', $comment);
        $this->assertArrayHasKey('time_changed', $comment);
        $this->assertArrayHasKey('author', $comment);
        $this->assertArrayHasKey('login', $comment['author']);
        $this->assertArrayHasKey('avatar', $comment);
        $this->assertArrayHasKey('is_can_vote', $comment);
        $this->assertArrayHasKey('vote', $comment);
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testGetCommentsForPostFail()
    {
        $this->resource->getCommentsForPost(-1);
    }

    public function testPostComment()
    {
        $fixtureComment = [
            'ok' => 1,
            'comment' => [
                'id' => 8841781,
                'message' => 'Коммент test',
                'time_published' => '2016-04-15T14:42:46+03:00',
            ],
            'server_time' => '2016-04-15T13:12:45+03:00'
        ];

        $this->adapter = new MockAdapter();
        $this->adapter->addPutHandler('/comments/259787', $fixtureComment);
        $this->resource->setAdapter($this->adapter);

        $actual = $this->resource->postComment(259787, 'Коммент test');

        $this->assertArrayHasKey('ok', $actual);
        $this->assertArrayHasKey('comment', $actual);
        $this->assertArrayHasKey('id', $actual['comment']);
        $this->assertArrayHasKey('message', $actual['comment']);
        $this->assertArrayHasKey('time_published', $actual['comment']);
        $this->assertArrayHasKey('server_time', $actual);
    }

    /**
     * @expectedException \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function testPostCommentFail()
    {
        $this->resource->postComment(-1, '');
    }

    public function testVotePlus()
    {
        $fixtureVote = [
            'ok' => 1,
            'score' => 100,
            'server_time' => '2016-04-15T13:12:45+03:00'
        ];

        $this->adapter = new MockAdapter();
        $this->adapter->addPutHandler('/comments/8841783/vote', $fixtureVote);
        $this->resource->setAdapter($this->adapter);

        $actual = $this->resource->votePlus(8841783);

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

    public function testVoteMinus()
    {
        $fixtureVote = [
            'ok' => 1,
            'score' => 100,
            'server_time' => '2016-04-15T13:12:45+03:00'
        ];

        $this->adapter = new MockAdapter();
        $this->adapter->addPutHandler('/comments/8841783/vote', $fixtureVote);
        $this->resource->setAdapter($this->adapter);

        $actual = $this->resource->voteMinus(8841783);

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
        $this->adapter->addPutHandler('/comments/8841783/vote', $fixtureVote);
        $this->resource->setAdapter($this->adapter);

        $actual = $this->resource->voteMinus(8841783);

        $this->assertArrayHasKey('code', $actual);
        $this->assertArrayHasKey('message', $actual);
        $this->assertArrayHasKey('additional', $actual);
    }
}
