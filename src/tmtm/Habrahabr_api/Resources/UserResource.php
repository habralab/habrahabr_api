<?php

    namespace tmtm\Habrahabr_api\Resources;

    /**
     * Ресурс для работы с пользователеми.
     *
     * Class UserResource
     * @package Habrahabr_api\Resources
     */
    class UserResource  extends abstractResource implements ResourceInterface
    {
        /**
         * Информация о пользователе по логину
         *
         * @param string $login
         *
         * @return mixed
         */
        public function getUser( $login )
        {
            return $this->adapter->get( sprintf('/users/%s', $login ) );
        }

        /**
         * Список пользователей с пагинацией
         *
         * @param int $page
         *
         * @return mixed
         */
        public function getUsersList( $page = 1 )
        {
            return $this->adapter->get( sprintf('/users?page=%d', $page ) );
        }

        /**
         * Комментарии пользователя с пагинацией
         *
         * @param string $login
         * @param int    $page
         *
         * @return mixed
         */
        public function getUserComments( $login, $page = 1 )
        {
            return $this->adapter->get( sprintf('/users/%s/comments?page=%d', $login, $page ) );
        }

        /**
         * Посты пользователя с пагинацией
         *
         * @param string $login
         * @param int    $page
         *
         * @return mixed
         */
        public function getUserPosts( $login, $page = 1 )
        {
            return $this->adapter->get( sprintf('/users/%s/posts?page=%d', $login, $page ) );
        }

        /**
         * Хабы на которые подписан пользователь
         *
         * @param string $login
         *
         * @return mixed
         */
        public function getUserHubs( $login )
        {
            return $this->adapter->get( sprintf('/users/%s/hubs', $login ) );
        }

        /**
         * Компании в которых работает пользователь
         *
         * @param string $login
         *
         * @return mixed
         */
        public function getUserCompanies( $login )
        {
            return $this->adapter->get( sprintf('/users/%s/companies', $login) );
        }


        /**
         * Кто подписан на пользователя, c пагинацией
         *
         * @param string $login
         * @param int    $page
         *
         * @return mixed
         */
        public function getUserFollowers( $login, $page = 1 )
        {
            return $this->adapter->get( sprintf('/users/%s/followers?page=%d', $login, $page ) );
        }

        /**
         * На кого подписан пользователь, c пагинацией
         *
         * @param string $login
         * @param int    $page
         *
         * @return mixed
         */
        public function getUserFollowed( $login, $page = 1 )
        {
            return $this->adapter->get( sprintf('/users/%s/followed?page=%d', $login, $page ) );
        }

        /**
         * Плюсовать карму пользователю.
         *
         * Этот метод может быть предоставлен дополнительно, по запросу.
         * http://habrahabr.ru/feedback/
         *
         * @param string $target
         *
         * @deprecated
         *
         * @return mixed
         */
        public function voteKarmaPlus( $target )
        {
            return $this->adapter->put( sprintf('/users/%s/vote', $target ) );
        }

        /**
         * Плюсовать карму пользователю
         *
         * Этот метод может быть предоставлен дополнительно, по запросу.
         * http://habrahabr.ru/feedback/
         *
         * @param string $target
         *
         * @deprecated
         *
         * @return mixed
         */
        public function voteKarmaMinus( $target )
        {
            return $this->adapter->delete( sprintf('/users/%s/vote', $target ) );
        }
    }