<?php

namespace Habrahabr\Api\HttpAdapter;

use Habrahabr\Api\Exception\IncorrectUsageException;

/**
 * Class BaseAdapter
 *
 * Базовый класс для всех Habrahabr Api HTTP адаптеров
 *
 * @package Habrahabr\Api\HttpAdapter
 * @version 0.0.8
 * @author thematicmedia <info@tmtm.ru>
 * @link https://tmtm.ru/
 * @link https://habrahabr.ru/
 * @link https://github.com/thematicmedia/habrahabr_api
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
abstract class BaseAdapter
{
    /**
     * @var null|string OAuth Token для доступа к API
     */
    protected $token = null;

    /**
     * @var null|string OAuth Client для доступа к API
     */
    protected $client = null;

    /**
     * @var null|string OAuth Endpoint для доступа к API
     */
    protected $endpoint;

    /**
     * @var int Количество секунд ожидания при попытке соединения
     */
    protected $connectionTimeout = 5;

    /**
     * Установить OAuth Token для доступа к API
     *
     * @param null|string $token OAuth Token для доступа к API
     * @return $this
     * @throws IncorrectUsageException
     */
    public function setToken($token)
    {
        if (!preg_match('#([a-z0-9]+)#ui', $token)) {
            throw new IncorrectUsageException('Incorrect API Token');
        }

        $this->token = $token;

        return $this;
    }

    /**
     * Установить OAuth Client для доступа к API
     *
     * @param null|string $client OAuth Client для доступа к API
     * @return $this
     * @throws IncorrectUsageException
     */
    public function setClient($client)
    {
        if (!preg_match('#([a-z0-9]+)\.([a-z0-9]+)#ui', $client)) {
            throw new IncorrectUsageException('Incorrect API Client');
        }

        $this->client = $client;

        return $this;
    }

    /**
     * Установить OAuth Endpoint для доступа к API
     *
     * @param null|string $url OAuth Endpoint для доступа к API
     * @return $this
     * @throws IncorrectUsageException
     */
    public function setEndpoint($url)
    {
        if (!preg_match('#^(https://)#ui', $url)) {
            throw new IncorrectUsageException('Scheme of endpoint must be HTTPS');
        }

        $this->endpoint = rtrim($url, '/');

        return $this;
    }

    /**
     * Получить OAuth Endpoint для доступа к API
     *
     * @return null|string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Установить количество секунд ожидания при попытке соединения
     *
     * @param int $connectionTimeout Количество секунд ожидания при попытке соединения
     * @return $this
     */
    public function setConnectionTimeout($connectionTimeout = 0)
    {
        $this->connectionTimeout = $connectionTimeout;

        return $this;
    }

    /**
     * Получить количество секунд ожидания при попытке соединения
     *
     * @return int
     */
    public function getConnectionTimeout()
    {
        return $this->connectionTimeout;
    }

    /**
     * Создание URL на базе OAuth Endpoint и URL ресурса
     *
     * @param $url URL ресурса
     * @return string
     */
    public function createUrl($url)
    {
        return $this->getEndpoint() . $url;
    }
}
