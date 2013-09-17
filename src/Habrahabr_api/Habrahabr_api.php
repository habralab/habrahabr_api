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

        /**
         * @return PostResource
         */
        public function getPostResource()
        {
            if( isset( $this->singleton['post_resource'] ) )
            {
                return $this->singleton['post_resource'];
            }

            $this->singleton['post_resource'] = (new PostResource())->setAdapter( $this->adapter );

            return $this->singleton['post_resource'];

        }

        /**
         * @return HubResource
         */
        public function getHubResource()
        {
            if( isset( $this->singleton['hub_resource'] ) )
            {
                return $this->singleton['hub_resource'];
            }

            $this->singleton['hub_resource'] = (new HubResource())->setAdapter( $this->adapter );

            return $this->singleton['hub_resource'];
        }

        /**
         * @return FeedResource
         */
        public function getFeedResource()
        {
            if( isset( $this->singleton['feed_resource'] ) )
            {
                return $this->singleton['feed_resource'];
            }

            $this->singleton['feed_resource'] = (new FeedResource())->setAdapter( $this->adapter );

            return $this->singleton['feed_resource'];
        }

        /**
         * @return CompanyResource
         */
        public function getCompanyResource()
        {
            if( isset( $this->singleton['company_resource'] ) )
            {
                return $this->singleton['company_resource'];
            }

            $this->singleton['company_resource'] = (new CompanyResource())->setAdapter( $this->adapter );

            return $this->singleton['company_resource'];
        }

        /**
         * @return CommentsResource
         */
        public function getCommentsResource()
        {
            if( isset( $this->singleton['comments_resource'] ) )
            {
                return $this->singleton['comments_resource'];
            }

            $this->singleton['comments_resource'] = (new CommentsResource())->setAdapter( $this->adapter );

            return $this->singleton['comments_resource'];
        }
        
//        private function getResource( $name )
//        {
//            $cache_name = strtolower( $name ) . '_resource';
//            $class_name = ucfirst( $name ) . 'Resource';
//
//            if( !class_exists( "\\Habrahabr_api\\Resources\\" . $class_name ) )
//            {
//                throw new ResourceNotExistsException( $class_name );
//            }
//
//            if( isset( $this->singleton[ $cache_name ] ) )
//            {
//                return $this->singleton[ $cache_name ];
//            }
//
//            $this->singleton[ $cache_name ] = (new $class_name())->setAdapter( $this->adapter );
//
//            return $this->singleton[ $cache_name ];
//        }
    }