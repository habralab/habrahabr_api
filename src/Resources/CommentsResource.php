<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\Exception\IncorrectUsageException;

/**
 * Class CommentsResource
 *
 * Ресурс работы с комментариями
 *
 * @package Habrahabr\Api\Resources
 * @version 0.1.5
 * @author thematicmedia <info@tmtm.ru>
 * @link https://tmtm.ru/
 * @link https://habrahabr.ru/
 * @link https://github.com/thematicmedia/habrahabr_api
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class CommentsResource extends AbstractResource implements ResourceInterface
{
    /**
     * @const Флаг голосования в плюс
     */
    const VOTE_PLUS = 1;

    /**
     * @const Флаг голосования в минус
     */
    const VOTE_MINUS = -1;

    /**
     * Возвращает список комментариев к посту по номеру
     *
     * @param int $post_id Номер поста
     * @return array
     * @throws IncorrectUsageException
     */
    public function getCommentsForPost($post_id)
    {
        $this->checkId($post_id);

        return $this->adapter->get(sprintf('/comments/%d', $post_id));
    }

    /**
     * Добавление комментария к посту по номеру
     *
     * @param int $post_id Номер поста
     * @param string $text Текст комментария
     * @param int $comment_id Номер комментария для ответа на комментарий
     * @return array
     * @throws IncorrectUsageException
     */
    public function postComment($post_id, $text, $comment_id = 0)
    {
        $this->checkId($post_id);

        $params = [
            'text' => $text,
            'parent_id' => $comment_id
        ];

        return $this->adapter->put(sprintf('/comments/%d', $post_id), $params);
    }

    /**
     * Положительное голосование за комментарий
     *
     * @param int $comment_id Номер комментария для голосования
     * @return array
     * @throws IncorrectUsageException
     */
    public function votePlus($comment_id)
    {
        $this->checkId($comment_id);

        return $this->vote($comment_id, self::VOTE_PLUS);
    }

    /**
     * Отрицательное голосование за комментарий
     *
     * @param int $comment_id Номер комментария для голосования
     * @return array
     * @throws IncorrectUsageException
     */
    public function voteMinus($comment_id)
    {
        $this->checkId($comment_id);

        return $this->vote($comment_id, self::VOTE_MINUS);
    }

    /**
     * Голосование за комментарий
     *
     * @param int $comment_id Номер комментария для голосования
     * @param int $vote Флаг голосования
     * @return array
     */
    private function vote($comment_id, $vote)
    {
        return $this->adapter->put(sprintf('/comments/%d/vote', $comment_id), ['vote' => $vote]);
    }
}
