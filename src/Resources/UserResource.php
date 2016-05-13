<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\Exception\IncorrectUsageException;

/**
 * Class UserResource
 *
 * Ресурс работы с пользователями
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
class UserResource extends AbstractResource implements ResourceInterface
{
    /**
     * Возвращает профиль пользователя API ключа
     *
     * @return array
     */
    public function getUserCurrent()
    {
        return $this->getUser('me');
    }

    /**
     * Возвращает профиль пользователя по логину
     *
     * @param string $login Логин пользователя на сайте
     * @return array
     * @throws IncorrectUsageException
     */
    public function getUser($login)
    {
        $this->checkAliasName($login);

        return $this->adapter->get(sprintf('/users/%s', $login));
    }

    /**
     * Возвращает список пользователей
     *
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function getUsersList($page = 1)
    {
        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/users?page=%d', $page));
    }

    /**
     * Возвращает комментарии пользователя по логину
     *
     * @param string $login Логин пользователя на сайте
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function getUserComments($login, $page = 1)
    {
        $this->checkAliasName($login);
        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/users/%s/comments?page=%d', $login, $page));
    }

    /**
     * Возвращает посты пользователя по логину
     *
     * @param string $login Логин пользователя на сайте
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function getUserPosts($login, $page = 1)
    {
        $this->checkAliasName($login);
        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/users/%s/posts?page=%d', $login, $page));
    }

    /**
     * Возвращает хабы на которые подписан пользователь
     *
     * @param string $login Логин пользователя на сайте
     * @return array
     * @throws IncorrectUsageException
     */
    public function getUserHubs($login)
    {
        $this->checkAliasName($login);

        return $this->adapter->get(sprintf('/users/%s/hubs', $login));
    }

    /**
     * Возвращает компании в которых работает пользователь
     *
     * @param string $login Логин пользователя на сайте
     * @return array
     * @throws IncorrectUsageException
     */
    public function getUserCompanies($login)
    {
        $this->checkAliasName($login);

        return $this->adapter->get(sprintf('/users/%s/companies', $login));
    }

    /**
     * Возвращает список подписчиков пользователя по логину
     *
     * @param string $login Логин пользователя на сайте
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function getUserFollowers($login, $page = 1)
    {
        $this->checkAliasName($login);
        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/users/%s/followers?page=%d', $login, $page));
    }

    /**
     * Возвращает список на кого подписан пользователь по логину
     *
     * @param string $login Логин пользователя на сайте
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function getUserFollowed($login, $page = 1)
    {
        $this->checkAliasName($login);
        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/users/%s/followed?page=%d', $login, $page));
    }

    /**
     * Плюсовать карму пользователя по логину
     *
     * Этот метод может быть предоставлен дополнительно, по запросу
     * https://habrahabr.ru/feedback/
     *
     * @param string $login Логин пользователя на сайте
     * @return array
     * @throws IncorrectUsageException
     */
    public function voteKarmaPlus($login)
    {
        $this->checkAliasName($login);

        return $this->adapter->put(sprintf('/users/%s/vote', $login));
    }

    /**
     * Минусовать карму пользователя по логину
     *
     * Этот метод может быть предоставлен дополнительно, по запросу
     * https://habrahabr.ru/feedback/
     *
     * @param string $login Логин пользователя на сайте
     * @return array
     */
    public function voteKarmaMinus($login)
    {
        return $this->adapter->delete(sprintf('/users/%s/vote', $login));
    }

    /**
     * Возвращает список "избранных" постов пользователя по логину
     *
     * @param string $login Логин пользователя на сайте
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function getUserFavoritesPost($login, $page = 1)
    {
        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/users/%s/favorites/posts?page=%d', $login, $page));
    }

    /**
     * Возвращает список "избранных" комментариев пользователя по логину
     *
     * @param string $login Логин пользователя на сайте
     * @param int $page Номер страницы
     * @return array
     * @throws IncorrectUsageException
     */
    public function getUserFavoritesComments($login, $page = 1)
    {
        $this->checkPageNumber($page);

        return $this->adapter->get(sprintf('/users/%s/favorites/comments?page=%d', $login, $page));
    }
}
