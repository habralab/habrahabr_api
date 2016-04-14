<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\Exception\IncorrectUsageException;

/**
 * Class TrackerResource
 *
 * Ресурс работы с трекером
 *
 * @package Habrahabr\Api\Resources
 * @version 0.0.8
 * @author thematicmedia <info@tmtm.ru>
 * @link https://tmtm.ru/
 * @link https://habrahabr.ru/
 * @link https://github.com/thematicmedia/habrahabr_api
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class TrackerResource extends AbstractResource implements ResourceInterface
{
    /**
     * Отправить сообщение в трекер
     *
     * @param string $title Заголова для пуша
     * @param string $text Текст для пуша
     * @return array
     * @throws IncorrectUsageException
     */
    public function push($title, $text)
    {
        // @TODO Работает ли это вообще?

        if (!is_string($title) || !is_string($text)) {
            throw new IncorrectUsageException('Push failed: Title or Text is not string');
        }

        return $this->adapter->put('/tracker', ['title' => $title, 'text' => $text]);
    }

    /**
     * Возвращает счетчики новых сообщений из трекера,
     * элементы не отмечаются как просмотренные
     *
     * @return array
     */
    public function getCounters()
    {
        return $this->adapter->get('/tracker/counters');
    }

    /**
     * Возвращает список постов из трекера,
     * элементы не отмечаются как просмотренные
     *
     * @return array
     */
    public function getPostsFeed()
    {
        return $this->adapter->get('/tracker/posts');
    }

    /**
     * Возвращает список подписчиков из трекера,
     * элементы не отмечаются как просмотренные
     *
     * @return array
     */
    public function getSubscribersFeed()
    {
        return $this->adapter->get('/tracker/subscribers');
    }

    /**
     * Возвращает список упоминаний из трекера,
     * элементы не отмечаются как просмотренные
     *
     * @return array
     */
    public function getMentions()
    {
        return $this->adapter->get('/tracker/mentions');
    }

    /**
     * Возвращает список сообщений приложений из трекера,
     * элементы не отмечаются как просмотренные
     *
     * @return array
     */
    public function getAppsFeed()
    {
        return $this->adapter->get('/tracker/apps');
    }
}
