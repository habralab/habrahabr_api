<?php

    namespace tmtm\Habrahabr_api\Resources;

    use tmtm\Habrahabr_api\HttpAdapter\HttpAdapterInterface;

    /**
     * Basic Resource class
     *
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