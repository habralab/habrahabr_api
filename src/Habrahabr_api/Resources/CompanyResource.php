<?php

    namespace Habrahabr_api\Resources;

    /**
     * Ресурс работы с компаниями
     *
     * @package Habrahabr_api\Resources
     */
    class CompanyResource implements ResourceInterface
    {
        use traitResource;

        /**
         * Список постов компании, с пагинацией.
         *
         * @param   string  $alias
         * @param   int     $page
         *
         * @return mixed
         */
        public function getCompanyPosts( $alias, $page = 1 )
        {
            return $this->adapter->get( sprintf('/company/%s?page=%d', $alias, $page ) );
        }

        public function getCompanyInfo( $alias )
        {
            return $this->adapter->get( sprintf('/company/%s/info', $alias ) );
        }
    }