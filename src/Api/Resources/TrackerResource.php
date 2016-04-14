<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\Exception\IncorrectUsageException;

class TrackerResource extends AbstractResource implements ResourceInterface
{
    /**
     * Отправляем сообщение в трекер пользователя.
     *
     * @param string $title
     * @param string $text
     *
     * @throws IncorrectUsageException
     *
     * @returm mixed
     */
    public function push($title, $text)
    {
        // @todo pre-validation title + text

        if (!is_string($title) || !is_string($text)) {
            throw new IncorrectUsageException('title or text invalid');
        }

        return $this->adapter->put('/tracker', ['title' => $title, 'text' => $text]);
    }

    /**
     * Получение счетчиков новых сообщений из трекера.
     *
     * Сообщения не отмечаются как просмотренные.
     *
     * @return mixed
     */
    public function getCounters()
    {
        return $this->adapter->get('/tracker/counters');
    }

    /**
     * Лента трекера "Посты".
     *
     * Сообщения не отмечаются как просмотренные.
     *
     * @return mixed
     */
    public function getPostsFeed()
    {
        return $this->adapter->get('/tracker/posts');
    }

    /**
     * Лента трекера "Подписчики".
     *
     * Сообщения не отмечаются как просмотренные.
     *
     * @return mixed
     */
    public function getSubscribersFeed()
    {
        return $this->adapter->get('/tracker/subscribers');
    }

    /**
     * Лента трекера "Упоминания".
     *
     * Сообщения не отмечаются как просмотренные.
     *
     * @return mixed
     */
    public function getMentions()
    {
        return $this->adapter->get('/tracker/mentions');
    }

    /**
     * Лента трекера "Приложения".
     *
     * Сообщения не отмечаются как просмотренные.
     *
     * @return mixed
     */
    public function getAppsFeed()
    {
        return $this->adapter->get('/tracker/apps');
    }
}
