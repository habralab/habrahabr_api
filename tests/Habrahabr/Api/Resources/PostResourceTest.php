<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\HttpAdapter\MockAdapter;
use Habrahabr\Api\Resources\PostResource;

class PostResourceTest extends \PHPUnit_Framework_TestCase
{
    const BAD_VOTE = -5;
    const BAD_VOTE_EXCEPTION = 'vote type incorrect';

    protected $adapter;
    protected $postResource;

    protected function setUp()
    {
        $this->adapter = new MockAdapter();
        $this->postResource = new PostResource();
        $this->postResource->setAdapter($this->adapter);
    }

    public function testGetPost()
    {
        $data = array(
            'data' => array(
                'id' => 123456,
                'is_tutorial' => false,
                'time_published' => '2006-07-13T18:23:39+04:00',
                'time_interesting' => '',
                'comments_count' => 39,
                'score' => 1,
                'votes_count' => 1,
                'favorites_count' => 6,
                'tags_string' => 'хабрахабр, api, unit-test, kafeman',
                'title' => 'Unit-test для API Хабрахабра',
                'preview_html' => 'Hello World! Long lo',
                'text_cut' => '',
                'text_html' => 'Hello World! Long long text.',
                'is_recovery_mode' => false,
                'hubs' => array(
                    array(
                        'count_posts' => 1569,
                        'count_subscribers' => 86428,
                        'is_profiled' => false,
                        'rating' => 0,
                        'alias' => 'ilovetests',
                        'title' => 'Unit-тесты',
                        'tags_string' => 'хабрахабр, habrhabr',
                        'about' => 'Unit-тесты всегда в тренде.',
                        'is_membership' => 1,
                        'is_company' => false
                    )
                ),
                'reading_count' => 7323,
                'author' => array(
                    'id' => 100500,
                    'login' => 'kafeman',
                    'time_registered' => '2006-06-02T16:52:56+04:00',
                    'score' => 361.5,
                    'fullname' => 'Кафеман Кафеманович',
                    'sex' => 1,
                    'rating' => 180.9,
                    'vote' => 1,
                    'rating_position' => 2,
                    'geo' => array(
                        'country' => 'Россия',
                        'region' => 'Москва и Московская обл.',
                        'city' => 'Москва'
                    ),
                    'counters' => array(
                        'posts' => 337,
                        'comments' => 1379,
                        'followed' => 188,
                        'followers' => 504
                    ),
                    'badges' => array(
                        array(
                            'alias' => 'habred',
                            'title' => 'Захабренный',
                            'plural' => 'Захабренные',
                            'description' => 'Пользователь с кармой >0.'
                        )
                    ),
                    'avatar' => 'http://habrastorage.org/getpro/habr/avatars/e1e/24c/4dd/e1e24c4dd18535b196b3b5c19d359bff.jpg',
                    'is_readonly' => false
                ),
                'has_polls' => false,
                'url' => 'http://habrahabr.ru/post/123456',
                'post_type' => 1,
                'post_type_str' => 'simple',
                'vote' => false,
                'is_can_vote' => false,
                'is_habred' => 1,
                'is_interesting' => false,
                'is_favorite' => false,
                'comments_new' => 2
            ),
            'server_time' => '2014-04-15T16:56:30+04:00'
        );
        $this->adapter->addGetHandler('/post/123456', $data);
        $result = $this->postResource->getPost(123456);
        $this->assertEquals($data, $result);
    }

    public function testVote()
    {
        // TODO(kafeman): Тут лучше разместить нормальный ответ, а не
        // ошибку. Но у меня нет прав для этого.
        $data = array(
            'code' => 403,
            'message' => 'Authorization required, bad scope',
            'additional' => array()
        );
        $this->adapter->addPutHandler('/post/123456/vote', $data);
        $result = $this->postResource->votePlus(123456, 1);
        $this->assertEquals($data, $result);

        $result = $this->postResource->votePlus(654321, 1);
        $this->assertFalse($result);
    }

//        public function testVoteException()
//        {
//            $this->setExpectedException( 'Habrahabr\Api\Exception\IncorrectUsageException', self::BAD_VOTE_EXCEPTION );
//            $this->postResource->voteMinus( 123456, self::BAD_VOTE );
//        }
}
