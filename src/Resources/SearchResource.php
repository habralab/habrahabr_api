<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\Exception\IncorrectUsageException;

/**
 * Class SearchResource
 *
 * Ресурс работы с поиском
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
class SearchResource extends AbstractResource implements ResourceInterface
{
    /**
     * Поиск произвольного запроса по постам
     *
     * @param string $q Поисковая фраза
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function searchPosts($q, $page = 1)
    {
        if (!is_string($q) OR empty($q)) {
            throw new IncorrectUsageException('Query must not be empty');
        }

        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/search/posts/%s?page=%d', urlencode($q), $page));
    }

    /**
     * Поиск произвольного запроса по пользователям
     *
     * @param string $q Поисковая фраза
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function searchUsers($q, $page = 1)
    {
        if (!is_string($q) OR empty($q)) {
            throw new IncorrectUsageException('Query must not be empty');
        }
        
        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/search/users/%s?page=%d', urlencode($q), $page));
    }

    /**
     * Поиск произвольного запроса по хабам
     *
     * @param string $q Поисковая фраза
     * @return array
     * @throws IncorrectUsageException
     */
    public function searchHubs($q)
    {
        if (!is_string($q) OR empty($q)) {
            throw new IncorrectUsageException('Query must not be empty');
        }
        
        return $this->adapter->get(sprintf('/hubs/search/%s', urlencode($q)));
    }
}
