<?php

    namespace tmtm\Habrahabr_api;

    use tmtm\Habrahabr_api\Exception\ResourceNotExistsException;

    use tmtm\Habrahabr_api\HttpAdapter\HttpAdapterInterface;
    use tmtm\Habrahabr_api\Resources\CommentsResource;
    use tmtm\Habrahabr_api\Resources\CompanyResource;
    use tmtm\Habrahabr_api\Resources\FeedResource;
    use tmtm\Habrahabr_api\Resources\HubResource;
    use tmtm\Habrahabr_api\Resources\PostResource;
    use tmtm\Habrahabr_api\Resources\ResourceInterface;
    use tmtm\Habrahabr_api\Resources\SearchResource;
    use tmtm\Habrahabr_api\Resources\TrackerResource;
    use tmtm\Habrahabr_api\Resources\UserResource;

    /**
     * Базовый класс, который работает как точка входа.
     *
     * @package Habrahabr_api
     */
    class Api
    {
        /** @var \tmtm\Habrahabr_api\HttpAdapter\HttpAdapterInterface */
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

            if ( !isset( $this->resource_instances[$class_name] ) ) {
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
            $full_name = '\\tmtm\\Habrahabr_api\\Resources\\' . $class_name;
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
