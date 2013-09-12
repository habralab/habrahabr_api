<?php

    namespace Habrahabr_api;

    use Habrahabr_api\HttpAdapter\HttpAdapterInterface;
    use Habrahabr_api\Resources\SearchResource;
    use Habrahabr_api\Resources\UserResource;

    /**
     * Class Habrahabr_api
     * @package Habrahabr_api
     */
    class Habrahabr_api
    {
        protected   $adapter;

        private     $singleton = [];

        /**
         * @param HttpAdapterInterface $adapter
         */
        public function __construct( HttpAdapterInterface $adapter = NULL )
        {
            $this->adapter = $adapter;
        }


        /**
         * @return UserResource
         */
        public function getUserResource()
        {
            if( isset( $this->singleton['user_resource'] ) )
            {
                return $this->singleton['user_resource'];
            }

            $this->singleton['user_resource'] = (new UserResource())->setAdapter( $this->adapter );

            return $this->singleton['user_resource'];
        }

        /**
         * @return SearchResource
         */
        public function getSearchResource()
        {
            if( isset( $this->singleton['search_resource'] ) )
            {
                return $this->singleton['search_resource'];
            }

            $this->singleton['search_resource'] = (new SearchResource())->setAdapter( $this->adapter );

            return $this->singleton['search_resource'];
        }
    }