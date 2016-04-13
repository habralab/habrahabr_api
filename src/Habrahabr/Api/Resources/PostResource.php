<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\Exception\IncorrectUsageException;

/**
 * Ресурс работы с постами
 *
 * @package Habrahabr_api\Resources
 */
class PostResource extends abstractResource implements ResourceInterface
{
    const VOTE_PLUS = 1;
    const VOTE_NEUTRAL = 0;
    const VOTE_MINUS = -1;

    /**
     * Получение поста по его id. ( без комментариев )
     *
     * @param   int $post_id
     *
     * @return  mixed
     */
    public function getPost($post_id)
    {
        return $this->adapter->get(sprintf('/post/%d', $post_id));
    }

    /**
     * Положительное за пост.
     *
     * Этот метод может быть предоставлен дополнительно, по запросу.
     * http://habrahabr.ru/feedback/
     * @param $post_id
     *
     * @return mixed
     * @throws \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function votePlus($post_id)
    {
        return $this->vote($post_id, self::VOTE_PLUS);
    }

    /**
     * Отрицательное голосование за пост.
     *
     * Этот метод может быть предоставлен дополнительно, по запросу.
     * http://habrahabr.ru/feedback/
     * @param $post_id
     *
     * @return mixed
     *
     * @throws \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function voteMinus($post_id)
    {
        return $this->vote($post_id, self::VOTE_PLUS);
    }

    /**
     * Нейтральное голосование за пост.
     *
     * Этот метод может быть предоставлен дополнительно, по запросу.
     * http://habrahabr.ru/feedback/
     * @param $post_id
     *
     * @return mixed
     * @throws \Habrahabr\Api\Exception\IncorrectUsageException
     */
    public function voteNeutral($post_id)
    {
        return $this->vote($post_id, self::VOTE_NEUTRAL);
    }

    /**
     * Добавить пост в избранное
     *
     * @param   int $post_id
     *
     * @return  mixed
     */
    public function addPostToFavorite($post_id)
    {
        return $this->adapter->put(sprintf('/post/%d/favorite', $post_id));
    }

    /**
     * Удалить пост из избранного
     *
     * @param   int $post_id
     *
     * @return  mixed
     */
    public function removePostFromFavorite($post_id)
    {
        return $this->adapter->delete(sprintf('/post/%d/favorite', $post_id));
    }

    /**
     * Голосование за пост.
     *
     * Этот метод может быть предоставлен дополнительно, по запросу.
     * http://habrahabr.ru/feedback/
     *
     * @param   int $post_id
     * @param   int $vote [ -1, 0, 1 ]
     *
     * @return mixed
     *
     * @throws \Habrahabr\Api\Exception\IncorrectUsageException
     */
    private function vote($post_id, $vote)
    {
        if (!in_array($vote, [self::VOTE_MINUS, self::VOTE_NEUTRAL, self::VOTE_PLUS], true)) {
            throw new IncorrectUsageException('vote type incorrect, must be (int) 1 || (int) -1 || (int) 0');
        }

        $params = ['vote' => $vote];

        return $this->adapter->put(sprintf('/post/%d/vote', $post_id), $params);
    }
}
