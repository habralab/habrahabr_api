<?php

    namespace Habrahabr_api\Resources;

    use Habrahabr_api\HttpAdapter\HttpAdapterInterface;
    use Habrahabr_api\HttpAdapter\traitAdapter;

    /**
     * Trait - Basic Resource functions
     *
     * Class traitResource
     * @package Habrahabr_api\Resources
     */
    trait traitResource
    {
        /**
         * @var HttpAdapterInterface
         */
        protected  $adapter;

        /**
         * @param HttpAdapterInterface $adapter
         *
         * @return $this
         */
        public function setAdapter( HttpAdapterInterface $adapter )
        {
            $this->adapter = $adapter;

            return $this;
        }

        // @todo magic methods ??
    }