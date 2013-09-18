<?php

    namespace Habrahabr_api\Resources;

    use Habrahabr_api\HttpAdapter\HttpAdapterInterface;

    /**
     * Trait - Basic Resource functions
     *
     * Class traitResource
     * @package Habrahabr_api\Resources
     */
    abstract class abstractResource
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