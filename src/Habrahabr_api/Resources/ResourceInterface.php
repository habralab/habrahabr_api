<?php

    namespace Habrahabr_api\Resources;

    use Habrahabr_api\HttpAdapter\HttpAdapterInterface;

    /**
     * Interface ResourceInterface
     *
     * @package Habrahabr_api\Resources
     *
     * @interface
     */
    interface ResourceInterface
    {
        public function setAdapter( HttpAdapterInterface $adapter );
    }