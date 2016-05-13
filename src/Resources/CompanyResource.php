<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\Exception\IncorrectUsageException;

/**
 * Class CompanyResource
 *
 * Ресурс работы с компаниями
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
class CompanyResource extends AbstractResource implements ResourceInterface
{
    /**
     * Возвращает посты компании по алиасу компании
     *
     * @param string $alias Алиасу компании на сайте
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function getCompanyPosts($alias, $page = 1)
    {
        $this->checkAliasName($alias);
        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/company/%s?page=%d', $alias, $page));
    }

    /**
     * Возвращает профиль компании по алиасу компании
     *
     * @param string $alias Алиасу компании на сайте
     * @return array
     * @throws IncorrectUsageException
     */
    public function getCompanyInfo($alias)
    {
        $this->checkAliasName($alias);
        
        return $this->adapter->get(sprintf('/company/%s/info', $alias));
    }

    /**
     * Возвращает список компаний
     *
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function getList($page = 1)
    {
        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/companies?page=%d', $page));
    }
}
