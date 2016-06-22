<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\Exception\IncorrectUsageException;

/**
 * Class PostResource
 *
 * Ресурс работы с постами
 *
 * @package Habrahabr\Api\Resources
 * @version 0.1.3
 * @author thematicmedia <info@tmtm.ru>
 * @link https://tmtm.ru/
 * @link https://habrahabr.ru/
 * @link https://github.com/thematicmedia/habrahabr_api
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class PostResource extends AbstractResource implements ResourceInterface
{
    /**
     * @const Флаг голосования в плюс
     */
    const VOTE_PLUS = 1;

    /**
     * @const Флаг голосования нейтрально
     */
    const VOTE_NEUTRAL = 0;

    /**
     * @const Флаг голосования в минус
     */
    const VOTE_MINUS = -1;

    /**
     * Возвращает пост по номеру
     *
     * @param int $post_id Номер поста
     * @return array
     * @throws IncorrectUsageException
     */
    public function getPost($post_id)
    {
        $this->checkId($post_id);

        return $this->adapter->get(sprintf('/post/%d', $post_id));
    }

    /**
     * Получить мета-информацию постов (не более 30 постов за раз)
     *
     * @param int $posts_id Номера постов
     * @return array
     * @throws IncorrectUsageException
     */
    public function getMeta($posts_id)
    {
        if (!is_array($posts_id)) {
            $posts_id = [$posts_id];
        }

        array_map([$this, 'checkId'], $posts_id);

        return $this->adapter->get(sprintf('/posts/meta?ids=%s', implode(',', $posts_id)));
    }

    /**
     * Положительное голосование за пост
     *
     * Этот метод может быть предоставлен дополнительно, по запросу
     * https://habrahabr.ru/feedback/
     *
     * @param int $post_id Номер поста
     * @return array
     * @throws IncorrectUsageException
     */
    public function votePlus($post_id)
    {
        $this->checkId($post_id);

        return $this->vote($post_id, self::VOTE_PLUS);
    }

    /**
     * Отрицательное голосование за пост
     *
     * Этот метод может быть предоставлен дополнительно, по запросу
     * https://habrahabr.ru/feedback/
     *
     * @param int $post_id Номер поста
     * @return array
     * @throws IncorrectUsageException
     */
    public function voteMinus($post_id)
    {
        $this->checkId($post_id);

        return $this->vote($post_id, self::VOTE_MINUS);
    }

    /**
     * Нейтральное голосование за пост
     *
     * Этот метод может быть предоставлен дополнительно, по запросу
     * https://habrahabr.ru/feedback/
     *
     * @param int $post_id Номер поста
     * @return array
     * @throws IncorrectUsageException
     */
    public function voteNeutral($post_id)
    {
        $this->checkId($post_id);

        return $this->vote($post_id, self::VOTE_NEUTRAL);
    }

    /**
     * Добавить пост в избранное
     *
     * @param int $post_id Номер поста
     * @return array
     * @throws IncorrectUsageException
     */
    public function addPostToFavorite($post_id)
    {
        $this->checkId($post_id);

        return $this->adapter->put(sprintf('/post/%d/favorite', $post_id));
    }

    /**
     * Удалить пост из избранного
     *
     * @param int $post_id Номер поста
     * @return array
     * @throws IncorrectUsageException
     */
    public function removePostFromFavorite($post_id)
    {
        $this->checkId($post_id);

        return $this->adapter->delete(sprintf('/post/%d/favorite', $post_id));
    }

    /**
     * Увеличить счетчик просмотров поста
     *
     * @param int $post_id Номер поста
     * @return array
     * @throws IncorrectUsageException
     */
    public function increaseCount($post_id)
    {
        $this->checkId($post_id);

        return $this->adapter->put(sprintf('/post/%d/viewcount', $post_id));
    }

    /**
     * Голосование за пост
     *
     * @param int $post_id Номер поста
     * @param int $vote Флаг голосования
     * @return array
     */
    private function vote($post_id, $vote)
    {
        return $this->adapter->put(sprintf('/post/%d/vote', $post_id), ['vote' => $vote]);
    }
}
