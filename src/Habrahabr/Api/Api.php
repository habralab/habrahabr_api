<?php

    namespace Habrahabr\Api;

    use Habrahabr\Api\Exception\ResourceNotExistsException;

    use Habrahabr\Api\HttpAdapter\HttpAdapterInterface;
    use Habrahabr\Api\Resources\CommentsResource;
    use Habrahabr\Api\Resources\CompanyResource;
    use Habrahabr\Api\Resources\FeedResource;
    use Habrahabr\Api\Resources\HubResource;
    use Habrahabr\Api\Resources\PostResource;
    use Habrahabr\Api\Resources\ResourceInterface;
    use Habrahabr\Api\Resources\SearchResource;
    use Habrahabr\Api\Resources\TrackerResource;
    use Habrahabr\Api\Resources\UserResource;

    /**
     * Базовый класс, который работает как точка входа.
     *
     * @package Habrahabr_api
     */
    class Api
    {
        /** @var \Habrahabr\Api\HttpAdapter\HttpAdapterInterface */
        protected $adapter;

        /** @var ResourceInterface[] */
        protected $resource_instances = [ ];

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
            return $this->getResource( 'user' );
        }

        /**
         * @return SearchResource
         */
        public function getSearchResource()
        {
            return $this->getResource( 'search' );
        }

        /**
         * @return PostResource
         */
        public function getPostResource()
        {
            return $this->getResource( 'post' );
        }

        /**
         * @return HubResource
         */
        public function getHubResource()
        {
            return $this->getResource( 'hub' );
        }

        /**
         * @return FeedResource
         */
        public function getFeedResource()
        {
            return $this->getResource( 'feed' );
        }

        /**
         * @return CompanyResource
         */
        public function getCompanyResource()
        {
            return $this->getResource( 'company' );
        }

        /**
         * @return CommentsResource
         */
        public function getCommentsResource()
        {
            return $this->getResource( 'comments' );
        }

        /**
         * @return TrackerResource
         */
        public function getTrackerResource()
        {
            return $this->getResource( 'tracker' );
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
        protected function getResource( $name )
        {
            $class_name = ucfirst( $name ) . 'Resource';

            if( !isset( $this->resource_instances[$class_name] ) )
            {
                $this->resource_instances[$class_name] = $this->createResourceInstance( $class_name );
            }

            return $this->resource_instances[$class_name];
        }

        /**
         * Создание класса ресурса
         *
         * @param string $class_name Имя класса-ресурса
         *
         * @return ResourceInterface
         * @throws Exception\ResourceNotExistsException
         */
        protected function createResourceInstance( $class_name )
        {
            $full_name = '\\Habrahabr\\Api\\Resources\\' . $class_name;

            if( !class_exists( $full_name ) )
            {
                throw new ResourceNotExistsException( $class_name );
            }

            /** @var ResourceInterface $resource_instance */
            $resource_instance = new $full_name();
            $resource_instance->setAdapter( $this->adapter );

            return $resource_instance;
        }
    }
