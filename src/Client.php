<?php

namespace Habrahabr\Api;

use Habrahabr\Api\Exception\ResourceNotExistsException;
use Habrahabr\Api\HttpAdapter\HttpAdapterInterface;
use Habrahabr\Api\Resources\ResourceInterface;

/**
 * Class Client
 *
 * Основной класс для получения доступа к классам Habrahabr Api ресурсов
 *
 * @package Habrahabr\Api
 * @version 0.1.0
 * @author thematicmedia <info@tmtm.ru>
 * @link https://tmtm.ru/
 * @link https://habrahabr.ru/
 * @link https://github.com/thematicmedia/habrahabr_api
 * @method Resources\UserResource getUserResource()
 * @method Resources\SearchResource getSearchResource()
 * @method Resources\PostResource getPostResource()
 * @method Resources\HubResource getHubResource()
 * @method Resources\FeedResource getFeedResource()
 * @method Resources\FlowResource getFlowResource()
 * @method Resources\CompanyResource getCompanyResource()
 * @method Resources\CommentsResource getCommentsResource()
 * @method Resources\TrackerResource getTrackerResource()
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

    /**
     * Возращает экземпляр ресурса для работы с Habrahabr Api
     *
     * @param string $name Название метода по шаблону get[Ресурс]Resource
     * @param array $arguments Список передаваемых экземпляру аргументов
     * @return ResourceInterface
     * @throws ResourceNotExistsException
     */
    public function __call($name, $arguments)
    {
        if (preg_match('#^get([\w]+)Resource$#i', $name, $m)) {
            $name = ucfirst($m[1]) . 'Resource';

            if (!isset($this->resources[$name])) {
                $this->resources[$name] = $this->createResourceInstance($name);
            }

            return $this->resources[$name];
        }

        throw new ResourceNotExistsException('Method ' . $name . ' not implemented');
    }

    /**
     * Создания экземпляра ресурса для работы с Habrahabr Api
     *
     * @param string $name Название класса для инициализации
     * @return ResourceInterface
     * @throws ResourceNotExistsException
     */
    protected function createResourceInstance($name)
    {
        $classname = '\\Habrahabr\\Api\\Resources\\' . $name;

        if (!class_exists($classname)) {
            throw new ResourceNotExistsException($name);
        }

        $resource = new $classname();
        $resource->setAdapter($this->adapter);

        return $resource;
    }
}
