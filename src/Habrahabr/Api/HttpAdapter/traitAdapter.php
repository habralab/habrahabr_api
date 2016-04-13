<?php

namespace Habrahabr\Api\HttpAdapter;

use Habrahabr\Api\Exception\IncorrectUsageException;

trait traitAdapter
{
    protected $token;
    protected $client;
    protected $endpoint;
    protected $connectionTimeout = 5;

    public function setToken($token)
    {
        // @todo validation??
        $this->token = $token;
    }

    public function setClient($client)
    {
        // @todo validation??
        $this->client = $client;
    }

    public function setEndpoint($url)
    {
        // @todo mb extract 'setVersion' ?

        $check = parse_url($url);

        if (empty($check['scheme']) || $check['scheme'] !== 'https') {
            throw new IncorrectUsageException('Scheme of endpoint must be https');
        }

        $url = rtrim($url, '/');

        $this->endpoint = $url;
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
