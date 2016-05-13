<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\Exception\IncorrectUsageException;
use Habrahabr\Api\HttpAdapter\HttpAdapterInterface;

/**
 * Class AbstractResource
 *
 * Базовый класс для всех Habrahabr Api ресурсов
 *
 * @package Habrahabr\Api\Resources
 * @version 0.1.0
 * @author thematicmedia <info@tmtm.ru>
 * @link https://tmtm.ru/
 * @link https://habrahabr.ru/
 * @link https://github.com/thematicmedia/habrahabr_api
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
abstract class AbstractResource
{
    /**
     * @var HttpAdapterInterface|null Экземпляр Habrahabr Api HTTP адаптера
     */
    protected $adapter;

    /**
     * Установить экземпляр Habrahabr Api HTTP адаптера для Habrahabr Api ресурса
     *
     * @param HttpAdapterInterface $adapter Экземпляр Habrahabr Api HTTP адаптера
     * @return $this
     */
    public function setAdapter(HttpAdapterInterface $adapter)
    {
        $this->adapter = $adapter;

        return $this;
    }

    /**
     * Проверяет ID на валидность
     *
     * @param mixed $id ID
     * @return bool
     * @throws IncorrectUsageException
     */
    protected function checkId($id)
    {
        if (intval($id) != $id || $id < 1) {
            throw new IncorrectUsageException('Id must be integer and positive');
        }

        return true;
    }

    /**
     * Проверяет Алиас на валидность
     *
     * @param mixed $alias Алиас
     * @return bool
     * @throws IncorrectUsageException
     */
    protected function checkAliasName($alias)
    {
        if (!preg_match('/^[a-z0-9\-_]+$/i', $alias)) {
            throw new IncorrectUsageException('Alias must be string without special chars');
        }

        return true;
    }

    /**
     * Проверяет номер страницы на валидность
     *
     * @param mixed $page Номер страницы
     * @return bool
     * @throws IncorrectUsageException
     */
    protected function checkPageNumber($page = 1)
    {
        if (intval($page) != $page || $page < 1) {
            throw new IncorrectUsageException('Page number must be integer and positive');
        }

        return true;
    }
}
