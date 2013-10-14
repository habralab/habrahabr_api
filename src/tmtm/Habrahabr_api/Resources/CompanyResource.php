<?php

    namespace tmtm\Habrahabr_api\Resources;

    /**
     * Ресурс работы с компаниями
     *
     * @package Habrahabr_api\Resources
     */
    class CompanyResource extends abstractResource implements ResourceInterface
    {
        /**
         * Список постов компании, с пагинацией.
         *
         * @param   string $alias
         * @param   int    $page
         *
         * @return mixed
         */
        public function getCompanyPosts( $alias, $page = 1 )
        {
            return $this->adapter->get( sprintf( '/company/%s?page=%d', $alias, $page ) );
        }

        /**
         * Получение информации о компании
         *
         * @param   string $alias
         *
         * @return mixed
         */
        public function getCompanyInfo( $alias )
        {
            return $this->adapter->get( sprintf( '/company/%s/info', $alias ) );
        }
    }