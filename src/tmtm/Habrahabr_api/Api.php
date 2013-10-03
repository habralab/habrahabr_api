<?php

    namespace tmtm\Habrahabr_api;

    use tmtm\Habrahabr_api\Exception\ResourceNotExistsException;

    use tmtm\Habrahabr_api\HttpAdapter\HttpAdapterInterface;

    use tmtm\Habrahabr_api\Resources\CommentsResource;
    use tmtm\Habrahabr_api\Resources\CompanyResource;
    use tmtm\Habrahabr_api\Resources\FeedResource;
    use tmtm\Habrahabr_api\Resources\SearchResource;
    use tmtm\Habrahabr_api\Resources\UserResource;
    use tmtm\Habrahabr_api\Resources\PostResource;
    use tmtm\Habrahabr_api\Resources\HubResource;
    use tmtm\Habrahabr_api\Resources\TrackerResource;
    use tmtm\Habrahabr_api\Resources\ResourceInterface;

    /**
     * Базовый класс, который работает как точка входа.
     *
     * @package Habrahabr_api
     */
    class Api
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
         * @return TrackerResource
         */
        public function getTrackerResource()
        {
            return $this->getResource('tracker');
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

            if( !class_exists( "\\tmtm\\Habrahabr_api\\Resources\\" . $class_name ) )
            {
                throw new ResourceNotExistsException( $class_name );
            }

            if( isset( $this->singleton[ $class_name ] ) )
            {
                return $this->singleton[ $class_name ];
            }

            $full_name = "\\tmtm\\Habrahabr_api\\Resources\\" . $class_name;

            /** @var ResourceInterface $full_name */
            $full_name = new $full_name();

            $this->singleton[ $class_name ] = $full_name->setAdapter( $this->adapter );

            return $this->singleton[ $class_name ];
        }
    }