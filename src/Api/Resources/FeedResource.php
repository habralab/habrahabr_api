<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\Exception\IncorrectUsageException;

/**
 * Class FeedResource
 *
 * Ресурс работы с "основной" лентой постов
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
class FeedResource extends AbstractResource implements ResourceInterface
{
    /**
     * Возвращает "Захабренные" посты из "основной" лентой постов
     *
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function getFeedHabred($page = 1)
    {
        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/feed/habred?page=%d', $page));
    }

    /**
     * Возвращает "Отхабренные" посты из "основной" лентой постов
     *
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function getFeedUnhabred($page = 1)
    {
        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/feed/unhabred?page=%d', $page));
    }

    /**
     * Возвращает "Новые" посты из "основной" лентой постов
     *
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function getFeedNew($page = 1)
    {
        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/feed/new?page=%d', $page));
    }
}
