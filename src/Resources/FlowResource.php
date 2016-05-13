<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\Exception\IncorrectUsageException;

/**
 * Class FlowResource
 *
 * Ресурс работы с потоками
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
class FlowResource extends AbstractResource implements ResourceInterface
{
    /**
     * Возвращает список потоков
     *
     * @return array
     */
    public function getFlows()
    {
        return $this->adapter->get('/flows');
    }

    /**
     * Возвращает "Интересные" посты из потока
     *
     * @param string $alias Алиаса потока
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function getFeedInteresting($alias, $page = 1)
    {
        $this->checkAliasName($alias);
        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/flows/%s/interesting?page=%d', $alias, $page));
    }

    /**
     * Возвращает "Все" посты посты из потока
     *
     * @param string $alias Алиаса потока
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function getFeedAll($alias, $page = 1)
    {
        $this->checkAliasName($alias);
        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/flows/%s/all?page=%d', $alias, $page));
    }

    /**
     * Возвращает "Лучшие" посты из потока
     *
     * @param string $alias Алиаса потока
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function getFeedBest($alias, $page = 1)
    {
        $this->checkAliasName($alias);
        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/flows/%s/best?page=%d', $alias, $page));
    }

    /**
     * Возвращает список хабов потока
     *
     * @param string $alias Алиаса потока
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function getHubList($alias, $page = 1)
    {
        $this->checkAliasName($alias);
        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/flows/%s/hubs?page=%d', $alias, $page));
    }
}
