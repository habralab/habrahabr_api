<?php

namespace Habrahabr\Api;

use Habrahabr\Api\Exception\ResourceNotExistsException;
use Habrahabr\Api\HttpAdapter\HttpAdapterInterface;
use Habrahabr\Api\Resources\CommentsResource;
use Habrahabr\Api\Resources\CompanyResource;
use Habrahabr\Api\Resources\FeedResource;
use Habrahabr\Api\Resources\HubResource;
use Habrahabr\Api\Resources\PostResource;
use Habrahabr\Api\Resources\ResourceInterface;
use Habrahabr\Api\Resources\SearchResource;
use Habrahabr\Api\Resources\TrackerResource;
use Habrahabr\Api\Resources\UserResource;

/**
 * Class Client
 *
 * Основной класс для получения доступа к классам Habrahabr Api ресурсов
 *
 * @package Habrahabr\Api
 * @version 0.0.8
 * @author thematicmedia <info@tmtm.ru>
 * @link https://tmtm.ru/
 * @link https://habrahabr.ru/
 * @link https://github.com/thematicmedia/habrahabr_api
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Client
{
    /**
     * @type HttpAdapterInterface|null Экземпляр Habrahabr Api HTTP адаптера
     */
    protected $adapter = null;

    /**
     * @type array Контейнер для хранения экземпляров классов ресурсов
     */
    protected $resources = [];

    /**
     * Client constructor.
     *
     * @param HttpAdapterInterface $adapter Экземпляр Habrahabr Api HTTP адаптера
     */
    public function __construct(HttpAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
    }

    /**
     * @return UserResource
     */
    public function getUserResource()
    {
        return $this->getResource('user');
    }

    /**
     * @return SearchResource
     */
    public function getSearchResource()
    {
        return $this->getResource('search');
    }

    /**
     * @return PostResource
     */
    public function getPostResource()
    {
        return $this->getResource('post');
    }

    /**
     * @return HubResource
     */
    public function getHubResource()
    {
        return $this->getResource('hub');
    }

    /**
     * @return FeedResource
     */
    public function getFeedResource()
    {
        return $this->getResource('feed');
    }

    /**
     * @return CompanyResource
     */
    public function getCompanyResource()
    {
        return $this->getResource('company');
    }

    /**
     * @return CommentsResource
     */
    public function getCommentsResource()
    {
        return $this->getResource('comments');
    }

    /**
     * @return TrackerResource
     */
    public function getTrackerResource()
    {
        return $this->getResource('tracker');
    }

    /**
     * Прокси синглтон метод
     *
     * @param $name
     *
     * @return mixed
     *
     * @throws Exception\ResourceNotExistsException
     */
    protected function getResource($name)
    {
        $class_name = ucfirst($name) . 'Resource';

        if (!isset($this->resources[$class_name])) {
            $this->resources[$class_name] = $this->createResourceInstance($class_name);
        }

        return $this->resources[$class_name];
    }

    /**
     * Создание класса-ресурса
     *
     * @param string $class_name Имя класса-ресурса
     *
     * @return ResourceInterface
     * @throws Exception\ResourceNotExistsException
     */
    protected function createResourceInstance($class_name)
    {
        $full_name = '\\Habrahabr\\Api\\Resources\\' . $class_name;

        if (!class_exists($full_name)) {
            throw new ResourceNotExistsException($class_name);
        }

        /** @var ResourceInterface $resource_instance */
        $resource_instance = new $full_name();
        $resource_instance->setAdapter($this->adapter);

        return $resource_instance;
    }
}
