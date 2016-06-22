<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\Exception\IncorrectUsageException;

/**
 * Class HubResource
 *
 * Ресурс работы с хабами
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
class HubResource extends AbstractResource implements ResourceInterface
{
    /**
     * Возвращает информацию о хабе по алиасу
     *
     * @param string $alias Алиаса хаба
     * @return array
     * @throws IncorrectUsageException
     */
    public function getHubInfo($alias)
    {
        $this->checkAliasName($alias);

        return $this->adapter->get(sprintf('/hub/%s/info', $alias));
    }

    /**
     * Возвращает "Захабренные" посты связаные с хабом
     *
     * @param string $alias Алиаса хаба
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function getFeedHabred($alias, $page = 1)
    {
        $this->checkAliasName($alias);
        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/hub/%s/habred?page=%d', $alias, $page));
    }

    /**
     * Возвращает "Отхабренные" посты связаные с хабом
     *
     * @param string $alias Алиаса хаба
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function getFeedUnhabred($alias, $page = 1)
    {
        $this->checkAliasName($alias);
        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/hub/%s/unhabred?page=%d', $alias, $page));
    }

    /**
     * Возвращает "Новые" посты связаные с хабом
     *
     * @param string $alias Алиаса хаба
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function getFeedNew($alias, $page = 1)
    {
        $this->checkAliasName($alias);
        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/hub/%s/new?page=%d', $alias, $page));
    }

    /**
     * Возвращает список хабов
     *
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function getHubList($page = 1)
    {
        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/hubs?page=%d', $page));
    }

    /**
     * Подписаться на хаб
     *
     * @param string $alias Алиаса хаба
     * @return array
     * @throws IncorrectUsageException
     */
    public function subscribeHub($alias)
    {
        $this->checkAliasName($alias);

        return $this->adapter->put(sprintf('/hub/%s', $alias));
    }

    /**
     * Отписаться от хаба
     *
     * @param string $alias Алиаса хаба
     * @return array
     * @throws IncorrectUsageException
     */
    public function unsubscribeHub($alias)
    {
        $this->checkAliasName($alias);

        return $this->adapter->delete(sprintf('/hub/%s', $alias));
    }
}
