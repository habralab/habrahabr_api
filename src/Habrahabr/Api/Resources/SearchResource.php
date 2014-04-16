<?php

    namespace Habrahabr\Api\Resources;

    /**
     * Ресурс для поиска
     *
     * @package Habrahabr_api\Resources
     */
    class SearchResource extends abstractResource implements ResourceInterface
    {
        /**
         * Поиск постов, с пагинацией
         *
         * @param string $string
         * @param int    $page
         *
         * @return mixed
         */
        public function searchPosts( $string, $page = 1 )
        {
            return $this->adapter->get( sprintf( '/search/posts/%s?page=%d', urlencode( $string ), $page ) );
        }

        /**
         * Поиск пользователей, с пагинацией
         *
         * @param string $string
         * @param int    $page
         *
         * @return mixed
         */
        public function searchUsers( $string, $page = 1 )
        {
            return $this->adapter->get( sprintf( '/search/users/%s?page=%d', urlencode( $string ), $page ) );
        }
    }