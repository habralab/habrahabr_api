<?php

    namespace Habrahabr_api\Resources;

    /**
     * Ресурс работы с "главной" лентой
     *
     * @package Habrahabr_api\Resources
     */
    class FeedResource  extends abstractResource implements ResourceInterface
    {
        /**
         * Список постов из ленты, с пагинацией, фильтр "Захабренные"
         *
         * @param   int     $page
         *
         * @return  mixed
         */
        public function getFeedHabred( $page = 1 )
        {
            return $this->adapter->get( sprintf('/feed/habred?page=%d', $page ) );
        }

        /**
         * Список постов из ленты, с пагинацией, фильтр "Отхабренные"
         *
         * @param   int     $page
         *
         * @return  mixed
         */
        public function getFeedUnhabred( $page = 1 )
        {
            return $this->adapter->get( sprintf('/feed/unhabred?page=%d', $page ) );
        }

        /**
         * Список постов из ленты, с пагинацией, фильтр "Новые"
         *
         * @param   int     $page
         *
         * @return  mixed
         */
        public function getFeedNew( $page = 1 )
        {
            return $this->adapter->get( sprintf('/feed/new?page=%d', $page ) );
        }
    }