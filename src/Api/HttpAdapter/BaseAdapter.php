<?php

namespace Habrahabr\Api\HttpAdapter;

use Habrahabr\Api\Exception\IncorrectUsageException;

/**
 * Class BaseAdapter
 *
 * Base for all Habrahabr Api HTTP adapters
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
    protected $token;
    protected $client;
    protected $endpoint;
    protected $connectionTimeout = 5;

    public function setToken($token)
    {
        if (!preg_match('#(\w+)#', $token)) {
            throw new IncorrectUsageException('Incorrect API Token');
        }

        $this->token = $token;
    }

    public function setClient($client)
    {
        if (!preg_match('#(\w+)#', $client)) {
            throw new IncorrectUsageException('Incorrect API Client');
        }

        $this->client = $client;
    }

    public function setEndpoint($url)
    {
        $check = parse_url($url);

        if (empty($check['scheme']) OR $check['scheme'] !== 'https') {
            throw new IncorrectUsageException('Scheme of endpoint must be HTTPS');
        }

        $this->endpoint = rtrim($url, '/');
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Устанавливает количество секунд ожидания при попытке соединения
     */
    public function setConnectionTimeout($connectionTimeout)
    {
        $this->connectionTimeout = $connectionTimeout;
    }

    public function getConnectionTimeout()
    {
        return $this->connectionTimeout;
    }

    /**
     * Создание полного URL для запроса ресурса
     *
     * @param string $resource_url Запрашиваемый ресурс
     *
     * @return string
     */
    public function createUrl($resource_url)
    {
        return $this->getEndpoint() . $resource_url;
    }
}
