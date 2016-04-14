<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\Exception\IncorrectUsageException;

/**
 * Ресурс для работы с Хабами
 *
 * @package Habrahabr_api\Resources
 */
class HubResource extends AbstractResource implements ResourceInterface
{
    /**
     * Получение информации о хабе по алиасу.
     *
     * @param string $alias
     *
     * @throws IncorrectUsageException
     *
     * @return mixed
     */
    public function getHubInfo($alias)
    {
        $this->checkAliasName($alias);

        return $this->adapter->get(sprintf('/hub/%s/info', $alias));
    }

    /**
     * Получение ленты хаба, с пагинацией, фильтр "Захабренные"
     *
     * @param   string $alias
     * @param   int $page
     *
     * @throws IncorrectUsageException
     *
     * @return mixed
     */
    public function getFeedHabred($alias, $page = 1)
    {
        $this->checkAliasName($alias);

        return $this->adapter->get(sprintf('/hub/%s/habred?page=%d', $alias, $page));
    }

    /**
     * Получение ленты хаба, с пагинацией, фильтр "Отхабренные"
     *
     * @param   string $alias
     * @param   int $page
     *
     * @throws IncorrectUsageException
     *
     * @return mixed
     */
    public function getFeedUnhabred($alias, $page = 1)
    {
        $this->checkAliasName($alias);

        return $this->adapter->get(sprintf('/hub/%s/unhabred?page=%d', $alias, $page));

    }

    /**
     * Получение ленты хаба, с пагинацией, фильтр "Новые"
     *
     * @param   string $alias
     * @param   int $page
     *
     * @throws IncorrectUsageException
     *
     * @return mixed
     */
    public function getFeedNew($alias, $page = 1)
    {
        $this->checkAliasName($alias);

        return $this->adapter->get(sprintf('/hub/%s/new?page=%d', $alias, $page));

    }

    /**
     * Все хабы
     *
     * @param int $page
     *
     * @return mixed
     */
    public function getHubList($page = 1)
    {
        return $this->adapter->get(sprintf('/hubs?page=%d', $page));
    }

    /**
     * Корневые категории хабов
     *
     * @return mixed
     */
    public function getHubCategories()
    {
        return $this->adapter->get('/hubs/categories');
    }

    /**
     * Хабы конкретной категории @see getHubCategories
     *
     * @param string $category ( alias )
     * @param int $page
     *
     * @return mixed
     */
    public function getHubOfCategory($category, $page = 1)
    {
        return $this->adapter->get(sprintf('/hubs/categories/%s?page=%d', $category, $page));
    }

    /**
     * Подписаться на хаб
     *
     * @param $alias
     *
     * @return mixed
     */
    public function subscribeHub($alias)
    {
        return $this->adapter->put(sprintf('/hub/%s', $alias));
    }

    /**
     * Отписаться от хаба
     *
     * @param $alias
     *
     * @return mixed
     */
    public function unsubscribeHub($alias)
    {
        return $this->adapter->delete(sprintf('/hub/%s', $alias));
    }

    /**
     * @param   string $alias
     *
     * @throws \Habrahabr\Api\Exception\IncorrectUsageException
     */
    private function checkAliasName($alias)
    {
        if (!preg_match('/^[a-z0-9\-_]+$/i', $alias)) {
            throw new IncorrectUsageException('bad alias - ' . $alias);
        }
    }
}
