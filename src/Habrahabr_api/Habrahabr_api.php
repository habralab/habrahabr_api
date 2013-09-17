<?php

    namespace Habrahabr_api;

    use Habrahabr_api\Exception\ResourceNotExistsException;

    use Habrahabr_api\HttpAdapter\HttpAdapterInterface;

    use Habrahabr_api\Resources\CommentsResource;
    use Habrahabr_api\Resources\CompanyResource;
    use Habrahabr_api\Resources\FeedResource;
    use Habrahabr_api\Resources\SearchResource;
    use Habrahabr_api\Resources\UserResource;
    use Habrahabr_api\Resources\PostResource;
    use Habrahabr_api\Resources\HubResource;

    /**
     * Базовый класс, который работает как точка входа.
     *
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
            return $this->getResource('user');
        }

        /**
         * @return SearchResource
         */
        public function getSearchResource()
        {
            return $this->getResource('search');
        }

        /**
         * @return PostResource
         */
        public function getPostResource()
        {
            return $this->getResource('post');
        }

        /**
         * @return HubResource
         */
        public function getHubResource()
        {
            return $this->getResource('hub');
        }

        /**
         * @return FeedResource
         */
        public function getFeedResource()
        {
            return $this->getResource('feed');
        }

        /**
         * @return CompanyResource
         */
        public function getCompanyResource()
        {
            return $this->getResource('company');
        }

        /**
         * @return CommentsResource
         */
        public function getCommentsResource()
        {
            return $this->getResource('comments');
        }

        /**
         * Прокси синглтон метод. Он не красивый и надо все поправить.
         *
         * @param $name
         *
         * @return mixed
         *
         * @throws Exception\ResourceNotExistsException
         */
        private function getResource( $name )
        {
            $class_name = ucfirst( $name ) . 'Resource';

            if( !class_exists( "\\Habrahabr_api\\Resources\\" . $class_name ) )
            {
                throw new ResourceNotExistsException( $class_name );
            }

            if( isset( $this->singleton[ $class_name ] ) )
            {
                return $this->singleton[ $class_name ];
            }

            $full_name = "\\Habrahabr_api\\Resources\\" . $class_name;

            $this->singleton[ $class_name ] = (new $full_name())->setAdapter( $this->adapter );

            return $this->singleton[ $class_name ];
        }
    }